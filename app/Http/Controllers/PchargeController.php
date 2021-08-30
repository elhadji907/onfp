<?php

namespace App\Http\Controllers;

use App\Models\Pcharge;
use App\Models\Etablissement;
use App\Models\Filiere;
use App\Models\Module;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PchargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware(['role:super-admin|Administrateur|Gestionnaire']); */
      /*   $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]); */
    }
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
        
        $depart = "2018";

        $enCours = date('Y');

        return view('pcharges.index', compact('pcharges', 'annees', 'total', 'an2019', 'an2020', 'an2021', 'an2022', 'depart', 'enCours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $etablissements = Etablissement::distinct('name')->get()->pluck('name', 'name')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();

        $enCours = date('Y');

        return view('pcharges.create', compact('etablissements', 'modules', 'enCours'));
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
                'annee'                 =>  'required|string|min:4|max:4',
                'civilite'              =>  'required|string',
                'firstname'             =>  'required|string|max:50',
                'name'                  =>  'required|string|max:50',
                'telephone'             =>  'required|string|max:50',
                'email'                 =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                'adresse'               =>  'required|string',
                'fixe'                  =>  'required|string|max:50',
                'lieu_naissance'        =>  'required|string|max:50',
                'etablissement'         =>  'required|string',
                'filiere'               =>  'required|string',
                'autre_filiere'         =>  'sometimes',
            ]);
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
    
    public function list(Request $request)
    {
        $etablissements=Etablissement::with('etablissement')->get();
        return Datatables::of($etablissements)->make(true);
    }
    
    public function liste(Request $request)
    {
        $filieres=Filiere::with('filiere')->get();
        return Datatables::of($filieres)->make(true);
    }
}
