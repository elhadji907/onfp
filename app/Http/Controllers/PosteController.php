<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PosteController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Gestionnaire']);
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'legende'   =>  ['required', 'string'],
            'image'     =>  ['required', 'image']

        ]);

        //dd(request('image'));
        $imagePath = request('image')->store('uplods', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->postes()->create([
            'legende' => $data['legende'],
            'image' => $imagePath
            ]);

        return redirect()->route('profiles.show', ['user'=>auth()->user()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function show(Poste $poste)
    {
        return view('postes.show', compact('poste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function edit(Poste $poste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poste $poste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poste $poste)
    {
        //
    }
}
