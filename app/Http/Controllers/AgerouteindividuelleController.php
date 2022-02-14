<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use App\Models\Projet;
use App\Models\Module;
use App\Models\Diplome;
use App\Models\Commune;
use App\Models\Familiale;
use App\Models\Professionnelle;
use App\Models\Etude;
use App\Models\Localite;
use App\Models\Zone;
use App\Models\User;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Diplomespro;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AgerouteindividuelleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($id);
        
        return view('agerouteindividuelles.index', compact('projet', 'projet_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diplomes = Diplome::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomespros = Diplomespro::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'id')->unique();

        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projetLocalites = Localite::join("projetslocalites", "projetslocalites.localites_id", "=", "localites.id")
        ->where("projetslocalites.projets_id", $id)
        ->get()->pluck('nom', 'nom')->unique();
        
        $projetZones = Zone::join("projetszones", "projetszones.zones_id", "=", "zones.id")
        ->where("projetszones.projets_id", $id)
        ->get()->pluck('nom', 'nom')->unique();

        $projetModules = Module::join("projetsmodules", "projetsmodules.modules_id", "=", "modules.id")
        ->where("projetsmodules.projets_id", $id)
        ->get()->pluck('name', 'name')->unique();
        
        return view('agerouteindividuelles.create', compact('etude', 'familiale', 'communes', 'diplomes', 'projetModules', 'projetZones', 'projetLocalites', 'projet_name', 'diplomespros'));
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
                'sexe'                              =>    'required|string|max:10',
                'numero_dossier'                    =>    'required|string|min:5|unique:individuelles,numero_dossier',
                'cin'                               =>    'required|string|min:13|max:15|unique:individuelles,cin',
                'prenom'                            =>    'required|string|max:50',
                'nom'                               =>    'required|string|max:50',
                'date_naiss'                        =>    'required|date_format:Y-m-d',
                'date_depot'                        =>    'required|date_format:Y-m-d',
                'lieu_naissance'                    =>    'required|string|max:50',
                'telephone'                         =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'telephone_secondaire'              =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'adresse'                           =>    'required|string|max:100',
                'email'                             =>    'required|string|email|max:255|unique:users,email',
                'familiale'                         =>    'required',
                'enfant'                            =>    'required|numeric',
                'etude'                             =>    'required',
                'commune'                           =>    'required',
                'diplome'                           =>    'required',
                'diplomespro'                       =>    'required',
                'activite_travail'                  =>    'required',
                'travail_renumeration'              =>    'required',
                'localites'                         =>    'required',
                'activite_avenir'                   =>    'required',
                'zones'                             =>    'required',
                'handicap'                          =>    'required',
                'situation_economique'              =>    'required',
                'victime_social'                    =>    'required',
                'modules'                           =>    'required',
                'dossier'                           =>    'required',
        ]
        );
        
        $handicap                           =        $request->input('handicap');
        $diplome                            =        $request->input('diplome');
        $diplomespro                        =        $request->input('diplomespro');
        $travail_renumeration               =        $request->input('travail_renumeration');
        $victime_social                     =        $request->input('victime_social');
        $autre_victime                      =        $request->input('autre_victime');

        if ($diplome == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes'                              =>    'required',
                    'annee_diplome'                                =>    'required|numeric',
                ]
            );
        } elseif ($diplomespro == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes_pros'                         =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        } elseif ($diplome != "Aucun") {
            $this->validate(
                $request,
                [
                    'annee_diplome'                                 =>    'required|numeric',
                ]
            );
        } elseif ($diplomespro != "Aucun") {
            $this->validate(
                $request,
                [
                    'specialite'                                   =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        } elseif ($travail_renumeration == "Oui") {
            $this->validate(
                $request,
                [
                    'salaire'                                      =>    'required',
                ]
            );
        } elseif ($handicap == "Oui") {
            $this->validate(
                $request,
                [
                    'preciser_handicap'                             =>    'required'
                ]
            );
        } elseif ($victime_social == "Autre") {
            $this->validate(
                $request,
                [
                    'autre_victime'                                 =>    'required'
                ]
            );
        } elseif ($victime_social == "Autre") {
            $this->validate(
                $request,
                [
                    'autre_victime'                                 =>    'required'
                ]
            );
        }

        $user_connect           =   Auth::user();
        
        $created_by1 = $user_connect->firstname;
        $created_by2 = $user_connect->name;
        $created_by3 = $user_connect->username;

        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';

        $user_id             =   User::latest('id')->first()->id;
        $username            =   strtolower($request->input('nom').$user_id);

        $annee = date('y');
        $longueur = strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   "I".strtolower("000000".$user_id."".$annee);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "I".strtolower("00000".$user_id."".$annee);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "I".strtolower("0000".$user_id."".$annee);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "I".strtolower("000".$user_id."".$annee);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   "I".strtolower("00".$user_id."".$annee);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   "I".strtolower("0".$user_id."".$annee);
        } else {
            $numero   =   "I".strtolower($user_id."".$annee);
        }

        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
        $telephone_secondaire = $request->input('telephone_secondaire');
        $telephone_secondaire = str_replace(' ', '', $telephone_secondaire);
        
        $diplome_id = Diplome::where('sigle', $request->input('diplome'))->first()->id;
        $diplomepro_id = Diplomespro::where('sigle', $request->input('diplomespro'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $familiale_id = $request->input('familiale');
        $etude_id = $request->input('etude');
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);



        $user = new User([
            'sexe'                      =>      $request->input('sexe'),
            'civilite'                  =>      $civilite,
            'firstname'                 =>      $request->input('prenom'),
            'name'                      =>      $request->input('nom'),
            'email'                     =>      $request->input('email'),
            'username'                  =>      $username,
            'telephone'                 =>      $telephone,
            'bp'                        =>      $request->input('bp'),
            'fax'                       =>      $request->input('fax'),
            'date_naissance'            =>      $request->input('date_naiss'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'adresse'                   =>      $request->input('adresse'),
            'password'                  =>      Hash::make($request->input('email')),
            'familiales_id'             =>      $familiale_id,
            'created_by'                =>      $created_by,
            'updated_by'                =>      $created_by

        ]);

        $user->save();

        $user->assignRole('Individuelle');
        $user->assignRole('Demandeur');
        
        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;

        $demandeur = new Demandeur([
                    'numero'                    =>     $numero,
                    'types_demandes_id'         =>     $types_demandes_id,
                    'users_id'                  =>     $user->id
                ]);
        
        $demandeur->save();

        $dossier = implode("; ", $request->get('dossier'));
        
        $individuelle = new Individuelle([
            'cin'                               =>     $cin,
            'numero_dossier'                    =>     $request->input('numero_dossier'),
            'date_depot'                        =>     $request->input('date_depot'),
            'nbre_pieces'                       =>     $request->input('nombre_de_piece'),
            'optiondiplome'                     =>     $request->input('specialite'),
            'adresse'                           =>     $request->input('adresse'),
            'autres_diplomes'                   =>     $request->input('autres_diplomes'),
            'autres_diplomes_pros'              =>     $request->input('autres_diplomes_pros'),
            'nbre_enfants'                      =>     $request->input('enfant'),
            'annee_diplome'                     =>     $request->input('annee_diplome'),
            'annee_diplome_professionelle'      =>     $request->input('annee_diplome_professionelle'),
            'activite_travail'                  =>     $request->input('activite_travail'),
            'travail_renumeration'              =>     $request->input('travail_renumeration'),
            'activite_avenir'                   =>     $request->input('activite_avenir'),
            'handicap'                          =>     $request->input('handicap'),
            'preciser_handicap'                 =>     $request->input('preciser_handicap'),
            'situation_economique'              =>     $request->input('situation_economique'),
            'victime_social'                    =>     $request->input('victime_social'),
            'salaire'                           =>     $request->input('salaire'),
            'dossier'                           =>     $dossier,
            'autre_diplomes_fournis'            =>     $request->input('autre_diplomes_fournis'),
            'statut'                            =>     'Attente',
            'telephone'                         =>     $telephone_secondaire,
            'etudes_id'                         =>     $etude_id,
            'communes_id'                       =>     $commune_id,
            'diplomes_id'                       =>     $diplome_id,
            'diplomespros_id'                   =>     $diplomepro_id,
            'demandeurs_id'                     =>     $demandeur->id
            ]);
            
        $individuelle->save();
        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet = Projet::find($projet_id);

        $zones_id = Zone::where('nom', $request->input('zones'))->first()->id;
        $localites_id = Localite::where('nom', $request->input('localites'))->first()->id;
        $modules_id = Module::where('name', $request->input('modules'))->first()->id;
        
        $individuelle->modules()->sync($modules_id);
        $individuelle->projets()->sync($projet_id);
        $individuelle->zones()->sync($zones_id);
        $individuelle->localites()->sync($localites_id);

        return redirect()->route('agerouteindividuelles.index')->with('success', 'demandeur ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function show(Individuelle $individuelle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $individuelle = Individuelle::find($id);
        $localite = Localite::get();
        $zone = Zone::get();
        $module = Module::get();
        $diplomes = Diplome::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomespros = Diplomespro::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'name')->unique();

        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        
        $projetZones = DB::table("projetszones")->where("projetszones.projets_id", $id)
        ->pluck('projetszones.zones_id', 'projetszones.zones_id')
        ->all();

        $projetLocalites = DB::table("projetslocalites")->where("projetslocalites.projets_id", $id)
        ->pluck('projetslocalites.localites_id', 'projetslocalites.localites_id')
        ->all();

        $projetZones = DB::table("projetszones")->where("projetszones.projets_id", $id)
        ->pluck('projetszones.zones_id', 'projetszones.zones_id')
        ->all();

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        return view('agerouteindividuelles.update', compact('individuelle', 'etude', 'familiale', 'communes', 'diplomes', 'projetModules', 'projetZones', 'projetLocalites', 'projet_name', 'diplomespros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Individuelle $individuelle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Individuelle $individuelle)
    {
        //
    }
}
