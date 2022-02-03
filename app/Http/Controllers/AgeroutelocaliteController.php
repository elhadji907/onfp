<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use App\Models\Zone;
use App\Models\Projet;
use App\Models\Projetslocalite;
use Illuminate\Http\Request;

class AgeroutelocaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        /* dd($projet_id); */

        $ageroutelocalite = Projet::all()->load(['localites'])
        ->where('name','=',$projet_name);

        foreach ($ageroutelocalite as $ageroutelocalites) {
        }

        /* dd($ageroutelocalites); */

        /* $ageroutelocalites = Localite::where('name', $projet_name)->get(); */

        /* dd($ageroutelocalites); */

        $zones = Zone::all();      

        /* dd($projet_name); */

        return view('ageroutelocalites.index', compact('ageroutelocalites', 'zones', 'projet_name'));
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
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function show(Localite $localite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function edit(Localite $localite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localite $localite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localite $localite)
    {
        //
    }
}
