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
use Auth;
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
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'id')->unique();
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
        
        return view('agerouteindividuelles.create', compact('etude', 'familiale', 'professionnelle', 'communes', 'diplomes', 'projetModules', 'projetZones', 'projetLocalites', 'projet_name'));
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
                'sexe'                =>  'required|string|max:10',
                'cin'                 =>  'required|string|min:13|max:15|unique:individuelles,cin',
                'prenom'              =>  'required|string|max:50',
                'nom'                 =>  'required|string|max:50',
                'date_naiss'          =>  'required|date_format:Y-m-d',
                'date_depot'          =>  'required|date_format:Y-m-d',
                'lieu_naissance'      =>  'required|string|max:50',
                'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:17',
                'etablissement'       =>  'required|string|max:100',
                'adresse'             =>  'required|string|max:100',
                'prerequis'           =>  'required|string|max:1500',
                'motivation'          =>  'required|string|max:1500',
                'email'               =>  'required|string|email|max:255|unique:users,email',
                'professionnelle'     =>  'required',
                'etude'               =>  'required',
                'commune'             =>  'required',
                'diplome'             =>  'required',
                'optiondiplome'       =>  'required',
                'localites'           =>  'required',
                'zones'               =>  'required',
                'modules'             =>  'required',
                'projet_professionnel'=>  'required|string|min:10',
        ]
        );

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
        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);
        
        $diplome_id = Diplome::where('name', $request->input('diplome'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $professionnelle_id = $request->input('professionnelle');
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
            'professionnelles_id'       =>      $professionnelle_id,
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
        
        $individuelle = new Individuelle([
            'cin'                       =>     $cin,
            'experience'                =>     $request->input('experience'),
            'information'               =>     $request->input('information'),
            'date_depot'                =>     $request->input('date_depot'),
            'nbre_pieces'               =>     $request->input('nombre_de_piece'),
            'prerequis'                 =>     $request->input('prerequis'),
            'etablissement'             =>     $request->input('etablissement'),
            'optiondiplome'             =>     $request->input('optiondiplome'),
            'adresse'                   =>     $request->input('adresse'),
            'motivation'                =>     $request->input('motivation'),
            'autres_diplomes'           =>     $request->input('autres_diplomes'),
            'qualification'             =>     $request->input('qualification'),
            'projetprofessionnel'       =>     $request->input('projet_professionnel'),
            'statut'                    =>     'Attente',
            'telephone'                 =>     $autre_tel,
            'etudes_id'                 =>     $etude_id,
            'communes_id'               =>     $commune_id,
            'diplomes_id'               =>     $diplome_id,
            'demandeurs_id'             =>     $demandeur->id
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
    public function edit(Individuelle $individuelle)
    {
        //
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
