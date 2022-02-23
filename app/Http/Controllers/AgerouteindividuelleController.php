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
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
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
        $this->middleware(['role:super-admin|Administrateur|Ageroute|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_projet = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($id_projet);
     
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
                'modules1'                           =>    'required',
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

        /* $dossier = implode(";", $request->get('dossier')); */
        
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
            'autre_victime'                     =>     $request->input('autre_victime'),
            'salaire'                           =>     $request->input('salaire'),
            'dossier'                           =>     $request->get('dossier'),
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
        $modules1_id = Module::where('name', $request->input('modules1'))->first()->id;
        $modules2_id = Module::where('name', $request->input('modules2'))->first()->id;
        $modules3_id = Module::where('name', $request->input('modules3'))->first()->id;
        
        $individuelle->modules()->attach($modules1_id);
        $individuelle->modules()->attach($modules2_id);
        $individuelle->modules()->attach($modules3_id);
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
    public function show($id)
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
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $individuelleLocalites = DB::table("individuelleslocalites")->where("individuelleslocalites.individuelles_id", $id)
        ->pluck('individuelleslocalites.localites_id', 'individuelleslocalites.localites_id')
        ->all();

        $individuelleZones = DB::table("individuelleszones")->where("individuelleszones.individuelles_id", $id)
        ->pluck('individuelleszones.zones_id', 'individuelleszones.zones_id')
        ->all();

        $individuelleModules = DB::table("individuellesmodules")->where("individuellesmodules.individuelles_id", $id)
        ->pluck('individuellesmodules.modules_id', 'individuellesmodules.modules_id')
        ->all();

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $projet_id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        $projetModules  = Module::find($projetModules);

        $prenom = $individuelle->demandeur->user->firstname;
        $nom = $individuelle->demandeur->user->name;

        $name = $prenom.' '.$nom;

        $name = htmlentities($name, ENT_NOQUOTES, 'utf-8');
        $name = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $name);
        $name = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $name);
        $name = preg_replace('#&[^;]+;#', '', $name);
        
        $anne = date('d');
        $anne = $anne.' '.date('m');
        $anne = $anne.' '.date('Y');
        $anne = $anne.' à '.date('H').'h';
        $anne = $anne.' '.date('i').'min';
        $anne = $anne.' '.date('s').'s';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml(view('agerouteindividuelles.show', compact(
            'localite',
            'projetModules',
            'zone',
            'module',
            'individuelle',
            'etude',
            'familiale',
            'communes',
            'diplomes',
            'individuelleModules',
            'individuelleZones',
            'individuelleLocalites',
            'projet_name',
            'diplomespros'
        )));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Fiche de candidature de '.$name.' du '.$anne.'.pdf', ['Attachment' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $individuelleLocalites = DB::table("individuelleslocalites")->where("individuelleslocalites.individuelles_id", $id)
        ->pluck('individuelleslocalites.localites_id', 'individuelleslocalites.localites_id')
        ->all();

        $individuelleZones = DB::table("individuelleszones")->where("individuelleszones.individuelles_id", $id)
        ->pluck('individuelleszones.zones_id', 'individuelleszones.zones_id')
        ->all();

        $individuelleModules = DB::table("individuellesmodules")->where("individuellesmodules.individuelles_id", $id)
        ->pluck('individuellesmodules.modules_id', 'individuellesmodules.modules_id')
        ->all();

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $projet_id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        $projetModules  = Module::find($projetModules);

        return view(
            'agerouteindividuelles.update',
            compact(
                'localite',
                'projetModules',
                'zone',
                'module',
                'individuelle',
                'etude',
                'familiale',
                'communes',
                'diplomes',
                'individuelleModules',
                'individuelleZones',
                'individuelleLocalites',
                'projet_name',
                'diplomespros'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $individuelle = Individuelle::find($id);
        $user_connect           =   Auth::user();
        $demandeur = $individuelle->demandeur;
        $utilisateur   =   $demandeur->user;

        /* $this->authorize('update',  $individuelle); */

        $this->validate(
            $request,
            [
                'sexe'                              =>    'required|string|max:10',
                'numero_dossier'                    =>    'required|string|min:5|unique:individuelles,numero_dossier,'.$id,
                'cin'                               =>    'required|string|min:13|max:15|unique:individuelles,cin,'.$id,
                'prenom'                            =>    'required|string|max:50',
                'nom'                               =>    'required|string|max:50',
                'date_naiss'                        =>    'required|date_format:Y-m-d',
                'date_depot'                        =>    'required|date_format:Y-m-d',
                'lieu_naissance'                    =>    'required|string|max:50',
                'telephone'                         =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'telephone_secondaire'              =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'adresse'                           =>    'required|string|max:100',
                'email'                             =>    'required|string|email|max:255|unique:users,email,'.$utilisateur->id,
                'familiale'                         =>    'required',
                'enfant'                            =>    'required|numeric',
                'etude'                             =>    'required',
                'commune'                           =>    'required',
                'diplome'                           =>    'required',
                'diplomespro'                       =>    'required',
                'activite_travail'                  =>    'required',
                'travail_renumeration'              =>    'required',
                'localite'                         =>    'required',
                'activite_avenir'                   =>    'required',
                'zone'                             =>    'required',
                'handicap'                          =>    'required',
                'situation_economique'              =>    'required',
                'victime_social'                    =>    'required',
                'module'                           =>    'required',
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
        }
      
        $updated_by1 = $user_connect->firstname;
        $updated_by2 = $user_connect->name;
        $updated_by3 = $user_connect->username;

        $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')';

        $user_id             =   User::latest('id')->first()->id;
        $username            =   strtolower($request->input('nom').$user_id);

        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $dossier = $request->input('autre_diplomes_fournis');
        $dossier = str_replace(' ', '', $dossier);

        if (($dossier) != "") {
            $dossier = "Copie diplomes ou attestations";
        } else {
            $dossier = "";
        }
        

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
        $telephone_secondaire = $request->input('telephone_secondaire');
        $telephone_secondaire = str_replace(' ', '', $telephone_secondaire);
        
        $diplome_id = Diplome::where('sigle', $request->input('diplome'))->first()->id;
        $diplomepro_id = Diplomespro::where('sigle', $request->input('diplomespro'))->first()->id;
        $familiale_id = Familiale::where('name', $request->input('familiale'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $etude_id = Etude::where('name', $request->input('etude'))->first()->id;
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);
        
        $utilisateur->sexe                      =      $request->input('sexe');
        $utilisateur->civilite                  =      $civilite;
        $utilisateur->firstname                 =      $request->input('prenom');
        $utilisateur->name                      =      $request->input('nom');
        $utilisateur->email                     =      $request->input('email');
        $utilisateur->username                  =      $request->input('username');
        $utilisateur->telephone                 =      $telephone;
        $utilisateur->bp                        =      $request->input('bp');
        $utilisateur->fax                       =      $request->input('fax');
        $utilisateur->date_naissance            =      $request->input('date_naiss');
        $utilisateur->lieu_naissance            =      $request->input('lieu_naissance');
        $utilisateur->adresse                   =      $request->input('adresse');
        $utilisateur->familiales_id             =      $familiale_id;
        $utilisateur->updated_by                =      $updated_by;

        $utilisateur->save();

        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;
        
        $demandeur->numero                      =      $request->input('numero');
        $demandeur->types_demandes_id           =      $types_demandes_id;
        $demandeur->users_id                    =      $utilisateur->id;

        $demandeur->save();

        /* $dossier = implode(";", $request->get('dossier')); */
        
        $individuelle->cin                             =     $cin;
        $individuelle->numero_dossier                  =     $request->input('numero_dossier');
        $individuelle->date_depot                      =     $request->input('date_depot');
        $individuelle->nbre_pieces                     =     $request->input('nombre_de_piece');
        $individuelle->optiondiplome                   =     $request->input('specialite');
        $individuelle->adresse                         =     $request->input('adresse');
        $individuelle->autres_diplomes                 =     $request->input('autres_diplomes');
        $individuelle->autres_diplomes_pros            =     $request->input('autres_diplomes_pros');
        $individuelle->nbre_enfants                    =     $request->input('enfant');
        $individuelle->annee_diplome                   =     $request->input('annee_diplome');
        $individuelle->annee_diplome_professionelle    =     $request->input('annee_diplome_professionelle');
        $individuelle->activite_travail                =     $request->input('activite_travail');
        $individuelle->travail_renumeration            =     $request->input('travail_renumeration');
        $individuelle->activite_avenir                 =     $request->input('activite_avenir');
        $individuelle->handicap                        =     $request->input('handicap');
        $individuelle->preciser_handicap               =     $request->input('preciser_handicap');
        $individuelle->situation_economique            =     $request->input('situation_economique');
        $individuelle->victime_social                  =     $request->input('victime_social');
        $individuelle->autre_victime                   =     $request->input('autre_victime');
        $individuelle->salaire                         =     $request->input('salaire');
        $individuelle->dossier                         =     $dossier;
        $individuelle->autre_diplomes_fournis          =     $request->input('autre_diplomes_fournis');
        $individuelle->telephone                       =     $telephone_secondaire;
        $individuelle->etudes_id                       =     $etude_id;
        $individuelle->communes_id                     =     $commune_id;
        $individuelle->diplomes_id                     =     $diplome_id;
        $individuelle->diplomespros_id                 =     $diplomepro_id;
        $individuelle->demandeurs_id                   =     $demandeur->id;
            
        $individuelle->save();
        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet = Projet::find($projet_id);
        
        /* $zones_id = Zone::where('nom', $request->input('zone'))->first()->id;
        $localites_id = Localite::where('nom', $request->input('localite'))->first()->id;
        $modules_id = Module::where('name', $request->input('module'))->first()->id; */
        
        $individuelle->modules()->sync($request->input('module'));
        $individuelle->projets()->sync($projet_id);
        $individuelle->zones()->sync($request->input('zone'));
        $individuelle->localites()->sync($request->input('localite'));

        $message = 'Bénéficiaire '.$utilisateur->firstname.' '.$utilisateur->name.' a été modifié avec succès';
        return redirect()->route('agerouteindividuelles.index')->with(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $individuelle   = Individuelle::find($id);
        $utilisateurs   =   $individuelle->demandeur->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
        
        $individuelle->delete();

        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été supprimé(e)';

        return redirect()->route('agerouteindividuelles.index')->with('success', $message);
    }


    public function listerparlocalite($projet, $localite)
    {
        $projet = Projet::find($projet);
        
        return view('agerouteindividuelles.listerparlocalite', compact('projet', 'localite'));
    }

    public function listerparmodulelocalite($projet, $localite, $module)
    {
        $projet = Projet::find($projet);
        $modules = Module::find($module);
        return view('agerouteindividuelles.listerparmodulelocalite', compact('projet', 'localite', 'module', 'modules'));
    }

    public function agerouteattente($statut)
    {
        $individuelles = Individuelle::get()->where('statut', '=', 'Attente');

        $effectif = Individuelle::get()->where('statut', '=', 'Attente')
                                  ->count();

        return view('agerouteindividuelles.attente', compact('statut', 'individuelles', 'effectif'));
    }

    public function moduleindividuelle($projet, $individuelle)
    {
        $projet = Projet::find($projet);
        $individuelle = Individuelle::find($individuelle);

        $cin_individuelle = $individuelle->cin;

        return view('agerouteindividuelles.moduleindividuelle', compact('projet', 'cin_individuelle'));
    }

    public function ageroutepresel($module, $statut, $individuelle)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut    =   $statut;
        $individuelle->statut1    =   $statut;
        $individuelle->module1    =   $module->name;
        
        $individuelle->save();
        
        $message = "La demande de prise en charge de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été accordée';
        return back()->with(compact('message'));
    }
}
