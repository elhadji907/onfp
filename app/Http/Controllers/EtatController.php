<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use Illuminate\Http\Request;

class EtatController extends Controller
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
     * @param  \App\Models\Etat  $etat
     * @return \Illuminate\Http\Response
     */
    public function show(Etat $etat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etat  $etat
     * @return \Illuminate\Http\Response
     */
    public function edit(Etat $etat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etat  $etat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etat $etat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etat  $etat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etat $etat)
    {
        //
    }
}
