<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Commune;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements      =   Etablissement::all();
        return view('etablissements.index', compact('etablissements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'id')->unique();
        return view('etablissements.create', compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'etablissement'         =>  'required|string|unique:etablissements,name,NULL,id,deleted_at,NULL',
                'telephone_1'           =>  'required|string|max:17',
                'telephone_2'           =>  'required|string|max:17',
                'email'                 =>  'required|string|email|max:255|unique:etablissements,email,NULL,id,deleted_at,NULL',
                'adresse'               =>  'required|string',
                'fixe'                  =>  'required|string|max:50',
                'commune'               =>  'required|string'
            ]);

            $etablissement = new Etablissement([      
                'name'                         =>      $request->input('etablissement'),
                'telephone1'                   =>      $request->input('telephone_1'),
                'telephone2'                   =>      $request->input('telephone_2'),
                'fixe'                         =>      $request->input('fixe'),
                'email'                        =>      $request->input('email'),
                'adresse'                      =>      $request->input('adresse'),
                'name'                         =>      $request->input('etablissement'),
                'sigle'                        =>      $request->input('sigle'),
                'communes_id'                  =>      $request->input('commune')
            ]);
    
            $etablissement->save();
            return redirect()->route('etablissements.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function show(Etablissement $etablissement)
    {
        $communes = Commune::all();
        return view('etablissements.show', compact('etablissement', 'communes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Etablissement $etablissement)
    {
        /* $communes = Commune::distinct('nom')->get()->pluck('nom', 'id')->unique(); */
        $communes = Commune::all();
        return view('etablissements.update', compact('etablissement', 'communes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etablissement $etablissement)
    {
        $this->validate($request, [
            'etablissement'         =>  "required|string|unique:etablissements,name,{$etablissement->id},id,deleted_at,NULL",
            'telephone_1'           =>  'required|string|max:17',
            'telephone_2'           =>  'required|string|max:17',
            'email'                 =>  "required|string|email|max:255|unique:etablissements,email,{$etablissement->id},id,deleted_at,NULL",
            'adresse'               =>  'required|string',
            'fixe'                  =>  'required|string|max:50',
            'commune'               =>  'required|string'
        ]);

        $communes_id = Commune::where('nom', $request->input('commune'))->first()->id;

        $etablissement->name                         =      $request->input('etablissement');
        $etablissement->telephone1                   =      $request->input('telephone_1');
        $etablissement->telephone2                   =      $request->input('telephone_2');
        $etablissement->fixe                         =      $request->input('fixe');
        $etablissement->email                        =      $request->input('email');
        $etablissement->adresse                      =      $request->input('adresse');
        $etablissement->name                         =      $request->input('etablissement');
        $etablissement->sigle                        =      $request->input('sigle');
        $etablissement->communes_id                  =      $communes_id;

        $etablissement->save();
        return redirect()->route('etablissements.index')->with('success','modification effectué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etablissement $etablissement)
    {

        $etablissement->delete();
        $message = $etablissement->name.' ['.$etablissement->sigle.'] a été supprimé';        
        return redirect()->route('etablissements.index')->with('success', $message);
    }

    public function list(Request $request)
    {
        $etablissements=Etablissement::withCount('pcharges')->with('commune')->get();
        return Datatables::of($etablissements)->make(true);
    }
    
}
