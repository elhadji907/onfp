<?php

namespace App\Http\Controllers;

use App\Models\Findividuelle;
use App\Models\Projet;
use App\Models\Programme;
use App\Models\User;
use App\Models\Typedemande;
use App\Models\Module;
use App\Models\Commune;
use App\Models\TypesOperateur;
use App\Models\Region;
use App\Models\Operateur;
use App\Models\TypesFormation;
use App\Models\Choixoperateur;
use App\Models\Formation;
use Illuminate\Http\Request;

class AgerouteformationController extends Controller
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
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projets = Projet::find($projet_id);

        return view('agerouteformations.index', compact('projets', 'projet_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $operateur_id = $request->input('operateur');
        $operateur = Operateur::find($operateur_id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('agerouteformations.create', compact('civilites', 'modules', 'communes', 'regions', 'types_operateurs', 'operateur', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
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
            $request,
            [
                /* 'date_debut'                        =>    'required|date_format:Y-m-d',
                'date_fin'                          =>    'required|date_format:Y-m-d', */
                'programme'                         =>    'required',
                'projet'                            =>    'required',
                'commune'                           =>    'required',
                'modules'                           =>    'required',
                'choixoperateur'                    =>    'required',
                'adresse'                           =>    'required',
                'beneficiaire'                      =>    'required',
                'types_formations'                  =>    'required',
        ]
        );

        $choixoperateur_id              =       Choixoperateur::where('trimestre', $request->input('choixoperateur'))->first()->id;
        $types_formations_id            =       TypesFormation::where('name', 'Individuelle')->first()->id;
        $projet_id                      =       Projet::where('name', $request->input('projet'))->first()->id;
        $commune_id                     =       Commune::where('nom', $request->input('commune'))->first()->id;
        $programme_id                   =       Programme::where('name', $request->input('programme'))->first()->id;
        $operateur_id                   =       Operateur::where('name', $request->input('operateur'))->first()->id;

        $nbre = rand(1, 9);
        $annee = date('dmy');
        $code = "FI".$nbre.''.$annee;

        $formation = new Formation([
            'code'                      =>      $code,
            'date_debut'                =>      $request->input('date_debut'),
            'date_fin'                  =>      $request->input('date_fin'),
            'adresse'                   =>      $request->input('adresse'),
            'beneficiaires'             =>      $request->input('beneficiaire'),
            'choixoperateurs_id'        =>      $choixoperateur_id,
            'types_formations_id'       =>      $types_formations_id,
            'operateurs_id'             =>      $operateur_id,

        ]);

        $formation->save();
        
        $findividuelle = new Findividuelle([
            'code'                  =>      $code,
            'modules_id'            =>      $request->input('modules'),
            'projets_id'            =>      $projet_id,
            'programmes_id'         =>      $programme_id,
            'formations_id'         =>      $formation->id,

        ]);

        $findividuelle->save();

        
        return redirect()->route('agerouteformations.index')->with('success', 'formation ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function show(Findividuelle $findividuelle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Findividuelle $findividuelle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Findividuelle $findividuelle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;

        $findividuelle->delete();

        $formation->delete();

        $message = $formation->choixoperateur->trimestre.' a été supprimé';
        return redirect()->route('agerouteformations.index')->with(compact('message'));
    }
}
