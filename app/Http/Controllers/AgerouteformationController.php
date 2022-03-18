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
use App\Models\Individuelle;
use App\Models\Statut;
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
                /* 'date_debut'          =>    'required|date_format:Y-m-d',
                'date_fin'            =>    'required|date_format:Y-m-d', */
                'programme'           =>    'required',
                'projet'              =>    'required',
                'commune'             =>    'required',
                'modules'             =>    'required',
                'choixoperateur'      =>    'required',
                'adresse'             =>    'required',
                'beneficiaire'        =>    'required',
                'types_formations'    =>    'required',
        ]
        );

        $choixoperateur_id            =       Choixoperateur::where('trimestre', $request->input('choixoperateur'))->first()->id;
        $types_formations_id          =       TypesFormation::where('name', 'Individuelle')->first()->id;
        $projet_id                    =       Projet::where('name', $request->input('projet'))->first()->id;
        $commune_id                   =       Commune::where('nom', $request->input('commune'))->first()->id;
        $programme_id                 =       Programme::where('name', $request->input('programme'))->first()->id;
        $operateur_id                 =       Operateur::where('name', $request->input('operateur'))->first()->id;
        $statuts_id                   =       Statut::where('name', 'Attente')->first()->id;

        $nbre = rand(1, 9);
        $annee = date('dmy');
        $code = "FI".$nbre.''.$annee;

        $formation = new Formation([
            'code'                     =>      $code,
            'date_debut'               =>      $request->input('date_debut'),
            'date_fin'                 =>      $request->input('date_fin'),
            'adresse'                  =>      $request->input('adresse'),
            'beneficiaires'            =>      $request->input('beneficiaire'),
            'modules_id'               =>      $request->input('modules'),
            'statuts_id'               =>      $statuts_id,
            'choixoperateurs_id'       =>      $choixoperateur_id,
            'types_formations_id'      =>      $types_formations_id,
            'operateurs_id'            =>      $operateur_id,
            'communes_id'              =>      $commune_id,

        ]);

        $formation->save();
        
        $findividuelle = new Findividuelle([
            'code'                     =>      $code,
            'modules_id'               =>      $request->input('modules'),
            'projets_id'               =>      $projet_id,
            'programmes_id'            =>      $programme_id,
            'formations_id'            =>      $formation->id,

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
    public function show($id)
    {
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;
        $individuelles = $formation->individuelles;
        
        return view('agerouteformations.show', compact('formation', 'findividuelle', 'individuelles'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $findividuelle = Findividuelle::find($id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('name', 'name')->unique();
        $operateurs = Operateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $statuts = Statut::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('agerouteformations.update', compact('civilites', 'statuts', 'modules', 'communes', 'regions', 'operateurs', 'types_operateurs', 'findividuelle', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'programme'           =>    'required',
                'projet'              =>    'required',
                'commune'             =>    'required',
                'modules'             =>    'required',
                'choixoperateur'      =>    'required',
                'adresse'             =>    'required',
                'beneficiaire'        =>    'required',
                'types_formations'    =>    'required',
        ]
        );
        
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;

        $choixoperateur_id              =       Choixoperateur::where('trimestre', $request->input('choixoperateur'))->first()->id;
        $types_formations_id            =       TypesFormation::where('name', 'Individuelle')->first()->id;
        $projet_id                      =       Projet::where('name', $request->input('projet'))->first()->id;
        $commune_id                     =       Commune::where('nom', $request->input('commune'))->first()->id;
        $programme_id                   =       Programme::where('name', $request->input('programme'))->first()->id;
        $module_id                      =       Module::where('name', $request->input('modules'))->first()->id;
        $operateurs_id                  =       Operateur::where('name', $request->input('operateur'))->first()->id;
        $statuts_id                     =       Statut::where('name', $request->input('statut'))->first()->id;
        
        $formation->code                =      $request->input('code');
        $formation->date_debut          =      $request->input('date_debut');
        $formation->date_fin            =      $request->input('date_fin');
        $formation->adresse             =      $request->input('adresse');
        $formation->beneficiaires       =      $request->input('beneficiaire');
        $formation->modules_id          =      $module_id;
        $formation->statuts_id          =      $statuts_id;
        $formation->choixoperateurs_id  =      $choixoperateur_id;
        $formation->types_formations_id =      $types_formations_id;
        $formation->operateurs_id       =      $operateurs_id;
        $formation->communes_id         =      $commune_id;

        $formation->save();
        
        $findividuelle->code            =      $request->input('code');
        $findividuelle->modules_id      =      $module_id;
        $findividuelle->projets_id      =      $projet_id;
        $findividuelle->programmes_id   =      $programme_id;
        $findividuelle->formations_id   =      $formation->id;

        $findividuelle->save();
        
        return redirect()->route('agerouteformations.index')->with('success', 'formation ajoutée avec succès !');
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

        $message = $formation->code.' a été supprimé';
        return redirect()->route('agerouteformations.index')->with(compact('message'));
    }

    public function formationcandidats($module, $projet, $programme, $findividuelle)
    {
        $individuelles      =           Individuelle::where('cin', '>', 0)->get();
        $module             =           Module::find($module);
        $projet             =           Projet::find($projet);
        $findividuelle      =           Findividuelle::find($findividuelle);
        $programme          =           Programme::find($programme);
        $projet_name        =           $projet->name;
        $module_name        =           $module->name;

        return view('agerouteformations.formationcandidats', compact('projet_name', 'individuelles', 'module_name', 'programme', 'findividuelle'));
    }

    public function individuelleformations($individuelle)
    {
        $individuelle = Individuelle::find($individuelle);
        return view('agerouteformations.individuelleformations', compact('individuelle'));
    }

    public function formationcandidatsadd($individuelle, $findividuelle)
    {
        $individuelle = Individuelle::find($individuelle);
        $findividuelle = Findividuelle::find($findividuelle);
        $formation = $findividuelle->formation;
        
        $individuelle->statut    =     "Retenue";

        $individuelle->save();
        $individuelle->formations()->sync($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été ajouté';
        return back()->with(compact('message'));
    }

    public function formationcandidatsdelete($individuelle, $findividuelle)
    {
        $individuelle = Individuelle::find($individuelle);
        $findividuelle = Findividuelle::find($findividuelle);
        $formation = $findividuelle->formation;
        
        $individuelle->statut    =     "Retirer";

        $individuelle->save();

        $individuelle->formations()->detach($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été ajouté';
        return back()->with(compact('message'));
    }

    public function codeformations($formation)
    {
        $formation = Formation::find($formation);
        $findividuelles = $formation->findividuelles;

        foreach ($findividuelles as $key => $findividuelle) {
        }
        
        return view('agerouteformations.codeformations', compact('formation', 'findividuelle'));
    }
}
