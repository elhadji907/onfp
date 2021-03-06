<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Carbon\Carbon;


class ListeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listes = Liste::all();
        
        return view('listes.index',compact('listes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anne = Carbon::today()->format('y');

        $anne_suivant = ++$anne;

        //dd($anne_suivant);

        $liste = Liste::all();

        $liste_id = Liste::latest('id')->first()->id;

        $liste_id = ++$liste_id;

        $feuil = 'Feuil'.$liste_id.'_'.$anne;

        return view('listes.create',compact('feuil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
               
                'numero' =>  'required|string|max:50|unique:listes,numero',
            ]
        );
        $liste = new Liste([      
            'numero'           =>      $request->input('numero'),

        ]);
        
        $liste->save();
        return redirect()->route('listes.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function show(Liste $liste)
    {
        $bordereaus = $liste->bordereaus;
        
        return view('listes.feuil', compact('bordereaus','liste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liste = Liste::find($id);
        return view('listes.update', compact('liste','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        
        $liste = Liste::find($id);
        $liste->numero  =   $request->input('numero');

        $this->validate(
            $request, 
            [
                'numero' =>  'required|string|max:50|unique:listes,numero,'.$liste->id,
            ]);   

        $liste->save();
        return redirect()->route('listes.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liste $liste)
    { 
        $liste->delete();
        $message = $liste->numero.' a été supprimé(e)';
        return redirect()->route('listes.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $listes=Liste::get();
        return Datatables::of($listes)->make(true);

    }
}
