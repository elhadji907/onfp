<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Gestionnaire|SAOS|ASAOS']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::get();
        return view('departements.create', compact('regions'));
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
               
                'nom'      =>  'required|string|max:50|unique:departements,nom',
                'region'   =>  'required|string',
            ]
        );
        $region_id = $request->input('region');
       /*  dd($region_id); */
        $departement = new Departement([      
            'nom'           =>      $request->input('nom'),
            'regions_id'    =>      $region_id

        ]);

        $departement->save();
        return redirect()->route('departements.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        $id = $departement->id;
        $region = $departement->region;
        $regions = Region::get();
        return view('departements.update', compact('departement','regions','region','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $this->validate(
            $request, 
            [
                'nom'      =>  'required|string|max:50|unique:departements,nom,'.$departement->id,
                'region'   =>  'required|string'
            ]);   

        $departement->nom          =   $request->input('nom');
        $departement->regions_id   =   $request->input('region');
        $departement->save();
        return redirect()->route('departements.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {        
        $departement->delete();
        $message = $departement->nom.' a été supprimé(e)';
        return redirect()->route('departements.index')->with(compact('message'));
    }
    
    public function list(Request $request)
    {
        $departements=Departement::with('region')->withCount('arrondissements')->get();
        return Datatables::of($departements)->make(true);
    }
}
