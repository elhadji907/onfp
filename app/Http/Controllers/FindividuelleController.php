<?php

namespace App\Http\Controllers;

use App\Models\Findividuelle;
use App\Models\Individuelle;
use App\Models\Ingenieur;
use App\Models\Module;
use App\Models\Commune;
use Carbon\Carbon;
use App\Models\Programme;
use App\Models\Formation;
use Illuminate\Http\Request;

class FindividuelleController extends Controller
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
        $findividuelles = Findividuelle::all();

        return view('findividuelles.index', compact('findividuelles'));
    }

    public function selectdindividuelles($id_commune, $id_module, $id_form)
    {
        $communes = Commune::find($id_commune);

        $modules = Module::find($id_module);

        $nom_module = $modules->name;

        $nom_commune = $communes->nom;

        $nom_region = $communes->arrondissement->departement->region->nom;

        $nom_formation = Formation::find($id_form);

        $individuelles = Individuelle::all()->load(['demandeur'])
        ->where('demandeur.commune.arrondissement.departement.region.nom', '=', $nom_region)
        ->where('module', '=', $nom_module)
        ->where('cin', '>', 0);

                
        return view('findividuelles.selectdindividuelles', compact('individuelles', 'communes', 'modules', 'nom_module', 'nom_commune', 'nom_region', 'nom_formation', 'id_form'));
    }

    public function adddindividuelles($id_ind, $id_form)
    {
        $individuelle = Individuelle::find($id_ind);
        $formation = Formation::find($id_form);
        
        $individuelle->formations()->sync($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été ajouté';
        return back()->with(compact('message'));
    }

    public function deleteindividuelles($id_ind, $id_form)
    {
        $individuelle = Individuelle::find($id_ind);
        $formation = Formation::find($id_form);
        //dd($individuelle);
        $individuelle->formations()->detach($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été enlevé';
        return back()->with(compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ingenieur_id=$request->input('ingenieur');
        $ingenieur=\App\Models\Ingenieur::find($ingenieur_id);
       
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('sigle', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'id')->unique();
       
        $date_debut = Carbon::now();
        $date_fin = Carbon::now()->addMonth();
        $operateur_id = $request->input('operateur');
        $operateur = Operateur::find($operateur_id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('findividuelles.create', compact('ingenieur', 'modules', 'communes', 'date_debut', 'date_fin', 'programmes', 'types_operateurs', 'operateur', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
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
                'date_debut'                        =>    'required|date_format:Y-m-d',
                'date_fin'                          =>    'required|date_format:Y-m-d',
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
        $name_ingenieur = $findividuelle->formation->ingenieur->name;

        $list_ingenieurs = Ingenieur::distinct('name')->get()->pluck('name', 'name')->unique();

        $ingenieurs = Ingenieur::all();

        return view('findividuelles.update', compact('findividuelle', 'ingenieurs', 'list_ingenieurs', 'name_ingenieur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Findividuelle $findividuelle)
    {
        //
    }

    
    public function list(Request $request)
    {
        $individuelles=Individuelle::with('demandeur')->get();
        dd($individuelles);
        return Datatables::of($individuelles)->make(true);
    }
}
