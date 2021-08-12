<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Courrier;
use App\Models\Demandeur;
use Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('auth'); */
        $this->middleware(['auth']);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        $demandeurs = Demandeur::all();

        $user_connect  =  auth::user()->demandeur;

        $courriers = Courrier::latest()->paginate(5);

        return view('profiles.show', compact('user','courriers','demandeurs','user_connect'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* $this->authorize('update', $user->profile); */

        $civilites = User::select('civilite')->distinct()->get();
        //dd($civilites);
        return view('profiles.edit', compact('user', 'civilites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /* $this->authorize('update', $user->profile); */
        
        $data = request()->validate([
            'civilite'        => ['required', 'string', 'max:50'],
            'firstname'        => ['required', 'string', 'max:50'],
            'name'             => ['required', 'string', 'max:50'],
            'username'         => ['string', 'min:5', 'max:10', 'unique:users'],
            'email'            => ['string', 'email', 'max:255', 'unique:users'],
            'date_naissance'   => ['required', 'date'],
            'lieu_naissance'   => ['required', 'string', 'max:50'],
            'telephone'        => ['required', 'string', 'max:50'],
            'image'            => ['sometimes', 'image', 'max:3000']

        ]);

         if (request('image')) {   
        $imagePath = request('image')->store('avatars', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
        $image->save();

           auth()->user()->profile->update([
            'image' => $imagePath
            ]);

            auth()->user()->update([
            'civilite' => $data['civilite'],
            'firstname' => $data['firstname'],
            'name' => $data['name'],
            'date_naissance' => $data['date_naissance'],
            'lieu_naissance' => $data['lieu_naissance'],
            'telephone' => $data['telephone']
            ]);

        }  else {
            auth()->user()->profile->update($data);

            auth()->user()->update([
                'civilite' => $data['civilite'],
                'firstname' => $data['firstname'],
                'name' => $data['name'],
                'date_naissance' => $data['date_naissance'],
                'lieu_naissance' => $data['lieu_naissance'],
                'telephone' => $data['telephone']
                ]);
        }

        return redirect()->route('profiles.show', ['user'=>auth()->user()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
