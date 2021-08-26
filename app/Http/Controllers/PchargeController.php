<?php

namespace App\Http\Controllers;

use App\Models\Pcharge;
use Illuminate\Http\Request;

class PchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annees = Pcharge::distinct('annee')->pluck('annee', 'annee');

        $an2019 = Pcharge::where('annee','2019')->count();
        $an2020 = Pcharge::where('annee','2020')->count();
        $an2021 = Pcharge::where('annee','2021')->count();
        $an2022 = Pcharge::where('annee','2022')->count();

        $total = Pcharge::get()->count();

        $pcharges      =   Pcharge::all();
        return view('pcharges.index', compact('pcharges', 'annees', 'total', 'an2019', 'an2020', 'an2021', 'an2022'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pcharges.create');
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
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function show(Pcharge $pcharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Pcharge $pcharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pcharge $pcharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pcharge $pcharge)
    {
        //
    }
}
