<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Commune;
use App\Models\Region;
use App\Models\Niveaux;
use App\Models\Diplome;
use App\Models\Demandeur;
use App\Models\Module;
use App\Models\Programme;
use App\Models\TypesDemande;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;

class IndividuelleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individuelles = Individuelle::all();
        $user = Auth::user();
        $user_connect = $user;
        $countries = DB::table('regions')->pluck("nom", "id");
        if (!$user->hasRole('Demandeur')) {
            return view('individuelles.index', compact('individuelles', 'countries'));
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        
        $date_depot = Carbon::now();

        $user = auth::user();
        
        $civilites = User::pluck('civilite', 'civilite');
        $familiale = User::pluck('situation_familiale', 'situation_familiale');

        if ($user->hasRole('Demandeur')) {
            foreach ($user->demandeur->individuelles as $key => $individuelle) {
            }
                $demandeurs = $user->demandeur;
                $individuelles = $demandeurs->individuelles;
                $utilisateurs = $user;
                return view('individuelles.update', compact('civilites', 'familiale', 'individuelle', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'utilisateurs'));
          
        } else {
            return view('individuelles.create', compact('civilites', 'familiale', 'user', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot'));
        }
    }

    public function findNomDept(Request $request)
    {
        $communes=Commune::select('nom', 'id')->where('arrondissements_id', $request->id)->take(100)->get();
        return response()->json($communes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_connect = Auth::user();
        $utilisateur = $user_connect;
        
        $individuelles = $user_connect->demandeur->individuelles;
        foreach ($individuelles as $individuelle) {

        }
        
        if (!$user_connect->hasRole('Demandeur')) {
                $this->validate(
                    $request,
                    [
                        'sexe'                =>  'required|string|max:10',
                        'cin'                 =>  'required|string|min:13|max:15|unique:individuelles,cin,NULL,id,deleted_at,NULL',
                        'prenom'              =>  'required|string|max:50',
                        'nom'                 =>  'required|string|max:50',
                        'date_naiss'          =>  'required|date_format:Y-m-d',
                        'date_depot'          =>  'required|date_format:Y-m-d',
                        'lieu_naissance'      =>  'required|string|max:50',
                        'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
                        'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
                        'etablissement'       =>  'required|string|max:100',
                        'adresse'             =>  'required|string|max:100',
                        'prerequis'           =>  'required|string|max:1500',
                        'motivation'          =>  'required|string|max:1500',
                        'email'               =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                        'familiale'           =>  'required',
                        'professionnelle'     =>  'required',
                        'niveau_etude'        =>  'required',
                        'commune'             =>  'required',
                        'modules'             =>  'exists:modules,id',
                        'diplome'             =>  'required',
                        'option'              =>  'required',
                    ]
                );
        }else {
            $this->validate(
                $request,
                [
                    'sexe'                =>  'required|string|max:10',
                    'cin'                 =>  "required|string|min:13|max:15|unique:individuelles,cin,{$individuelle->id},id,deleted_at,NULL",
                    'prenom'              =>  'required|string|max:50',
                    'nom'                 =>  'required|string|max:50',
                    'date_naiss'          =>  'required|date_format:Y-m-d',
                    'date_depot'          =>  'required|date_format:Y-m-d',
                    'lieu_naissance'      =>  'required|string|max:50',
                    'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
                    'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
                    'etablissement'       =>  'required|string|max:100',
                    'adresse'             =>  'required|string|max:100',
                    'prerequis'           =>  'required|string|max:1500',
                    'motivation'          =>  'required|string|max:1500',
                    'email'               =>  "required|string|email|max:255|unique:users,email,{$user_connect->id},id,deleted_at,NULL",
                    'familiale'           =>  'required',
                    'professionnelle'     =>  'required',
                    'niveau_etude'        =>  'required',
                    'commune'             =>  'required',
                    'modules'             =>  'exists:modules,id',
                    'diplome'             =>  'required',
                    'option'              =>  'required',
                ]
            );
        }

        $user_id             =   User::latest('id')->first()->id;
        $username            =   strtolower($request->input('nom').$user_id);

        $annee = date('y');
        $longueur = strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   "I".strtolower($annee."000000".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "I".strtolower($annee."00000".$user_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "I".strtolower($annee."0000".$user_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "I".strtolower($annee."000".$user_id);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   "I".strtolower($annee."00".$user_id);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   "I".strtolower($annee."0".$user_id);
        } else {
            $numero   =   "I".strtolower($annee.$user_id);
        }
       
        //$commune = commune::find($request->input('commune'));
        /*  $region = $commune->region->nom;
         $region_id = $commune->region->id; */

        $created_by1 = $user_connect->firstname;
        $created_by2 = $user_connect->name;
        $created_by3 = $user_connect->username;

        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';

        $statut = "Attente";

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);

        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);
       
        if ($request->input('programme') !== null) {
            $programme_id = Programme::where('sigle', $request->input('programme'))->first()->id;
        } else {
            $programme_id = null;
        }

        $diplome_id = Diplome::where('name', $request->input('diplome'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        //$modules = Module::where('id',$request->input('modules'))->first()->name;
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);

        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;
        
        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $user = new User([
            'sexe'                      =>      $request->input('sexe'),
            'civilite'                  =>      $civilite,
            'firstname'                 =>      $request->input('prenom'),
            'name'                      =>      $request->input('nom'),
            'email'                     =>      $request->input('email'),
            'username'                  =>      $username,
            'telephone'                 =>      $telephone,
            'fixe'                      =>      $fixe,
            'bp'                        =>      $request->input('bp'),
            'fax'                       =>      $request->input('fax'),
            'situation_familiale'       =>      $request->input('familiale'),
            'situation_professionnelle' =>      $request->input('professionnelle'),
            'date_naissance'            =>      $request->input('date_naiss'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'adresse'                   =>      $request->input('adresse'),
            'password'                  =>      Hash::make($request->input('email')),
            'created_by'                =>      $created_by,
            'updated_by'                =>      $created_by

        ]);
    
            $user->save();
            $user->assignRole('Demandeur');
            
            $demandeur = new Demandeur([
                'numero'                    =>     $numero,
                'date_depot'                =>     $request->input('date_depot'),
                'nbre_piece'                =>     $request->input('nombre_de_piece'),
                'niveau_etude'              =>     $request->input('niveau_etude'),
                'etablissement'             =>     $request->input('etablissement'),
                'telephone'                 =>     $autre_tel,
                'fixe'                      =>     $fixe,
                'programmes_id'             =>     $programme_id,
                'option'                    =>     $request->input('option'),
                'adresse'                   =>     $request->input('adresse'),
                'motivation'                =>     $request->input('motivation'),
                'autres_diplomes'           =>     $request->input('autres_diplomes'),
                'experience'                =>     $request->input('experience'),
                'qualification'             =>     $request->input('qualification'),
                'communes_id'               =>     $commune_id,
                'types_demandes_id'         =>     $types_demandes_id,
                'diplomes_id'               =>     $diplome_id,
                'users_id'                  =>     $user_connect->id
            ]);
    
            $demandeur->save();
    
            $individuelle = new Individuelle([
                'cin'               =>     $cin,
                'experience'        =>     $request->input('experience'),
                'information'       =>     $request->input('information'),
                'nbre_pieces'       =>     $request->input('nombre_de_piece'),
                'information'       =>     $request->input('information'),
                'prerequis'         =>     $request->input('prerequis'),
                'statut'            =>     $statut,
                'demandeurs_id'     =>     $demandeur->id
            ]);
    
            $individuelle->save();
            $individuelle->modules()->sync($request->input('modules'));

        if (!$user_connect->hasRole('Demandeur')) {
            return redirect()->route('individuelles.index')->with('success', 'demandeur ajouté avec succès !');
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
        
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function show(Individuelle $individuelle)
    {
        $utilisateurs = $individuelle->demandeur->user;

        $civilites = User::pluck('civilite', 'civilite');
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $niveaux = Niveaux::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = commune::distinct('nom')->get()->pluck('nom', 'id')->unique();

        
        return view('individuelles.show', compact(
            'individuelle',
            'communes',
            'niveaux',
            'modules',
            'programmes',
            'diplomes',
            'utilisateurs',
            'civilites'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Individuelle $individuelle)
    {
        /* $this->authorize('update',  $individuelle); */
       
        $demandeurs = $individuelle->demandeur;
        $utilisateurs = $demandeurs->user;

        $civilites = User::pluck('civilite', 'civilite');

        $modules = Module::distinct('name')->pluck('name', 'id')->unique();
        $moduleIndividuelle = $individuelle->modules->pluck('name', 'name')->all();
        /* dd($moduleIndividuelle); */
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();

        $date_depot = Carbon::now();

        return view('individuelles.update', compact('civilites', 'individuelle', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'utilisateurs', 'moduleIndividuelle'));
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
        $user_connect = Auth::user();
        $demandeur = $individuelle->demandeur;
        $utilisateur   =   $demandeur->user;

        /* $this->authorize('update',  $individuelle); */

        if (!$user_connect->hasRole('Demandeur')) {
            $this->validate(
                $request,
                [
               'sexe'                =>  'required|string|max:10',
               'cin'                 =>  "required|string|min:13|max:15|unique:individuelles,cin,{$individuelle->id},id,deleted_at,NULL",
               'prenom'              =>  'required|string|max:50',
               'nom'                 =>  'required|string|max:50',
               'date_naiss'          =>  'required|date_format:Y-m-d',
               'date_depot'          =>  'required|date_format:Y-m-d',
               'lieu_naissance'      =>  'required|string|max:50',
               'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
               'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
               'etablissement'       =>  'required|string|max:100',
               'adresse'             =>  'required|string|max:100',
               'prerequis'           =>  'required|string|max:1500',
               'motivation'          =>  'required|string|max:1500',
               'email'               =>  'required|email|max:255|unique:users,email,'.$individuelle->demandeur->user->id,
               'familiale'           =>  'required',
               'professionnelle'     =>  'required',
               'niveau_etude'        =>  'required',
               'commune'             =>  'required',
               'modules'             =>  'required',
               'diplome'             =>  'required',
               'option'              =>  'required',
               ]
            );
        } else {
            $this->validate(
                $request,
                [
               'sexe'                =>  'required|string|max:10',
               'cin'                 =>  "required|string|min:13|max:15|unique:individuelles,cin,{$individuelle->id},id,deleted_at,NULL",
               'prenom'              =>  'required|string|max:50',
               'nom'                 =>  'required|string|max:50',
               'date_naiss'          =>  'required|date_format:Y-m-d',
               'date_depot'          =>  'required|date_format:Y-m-d',
               'lieu_naissance'      =>  'required|string|max:50',
               'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
               'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
               'etablissement'       =>  'required|string|max:100',
               'adresse'             =>  'required|string|max:100',
               'prerequis'           =>  'required|string|max:1500',
               'motivation'          =>  'required|string|max:1500',
               'email'               =>  'required|email|max:255',
               'familiale'           =>  'required',
               'professionnelle'     =>  'required',
               'niveau_etude'        =>  'required',
               'commune'             =>  'required',
               'modules'             =>  'required',
               'diplome'             =>  'required',
               'option'              =>  'required',
               ]
            );
        }

        $updated_by1 = $user_connect->firstname;
        $updated_by2 = $user_connect->name;
        $updated_by3 = $user_connect->username;

        $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')';


        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
 
        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);
 
        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);
 
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);
        if ($request->input('programme') !== null) {
            $programme_id = Programme::where('sigle', $request->input('programme'))->first()->id;
        } else {
            $programme_id = "";
        }

        $sexe = $request->input('sexe');
        if ($sexe == "M") {
            $civilite = "M.";
        } elseif ($sexe == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $statut = "Attente";

        $diplome_id = Diplome::where('name', $request->input('diplome'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;

        $utilisateur->sexe                      =      $sexe;
        $utilisateur->civilite                  =      $civilite;
        $utilisateur->firstname                 =      $request->input('prenom');
        $utilisateur->name                      =      $request->input('nom');
        $utilisateur->email                     =      $request->input('email');
        $utilisateur->username                  =      $request->input('username');
        $utilisateur->telephone                 =      $telephone;
        $utilisateur->fixe                      =      $fixe;
        $utilisateur->bp                        =      $request->input('bp');
        $utilisateur->fax                       =      $request->input('fax');
        $utilisateur->situation_familiale       =      $request->input('familiale');
        $utilisateur->situation_professionnelle =      $request->input('professionnelle');
        $utilisateur->date_naissance            =      $request->input('date_naiss');
        $utilisateur->lieu_naissance            =      $request->input('lieu_naissance');
        $utilisateur->adresse                   =      $request->input('adresse');
        $utilisateur->updated_by               =      $updated_by;

        $utilisateur->save();

        $demandeur->numero                      =      $request->input('numero');
        $demandeur->date_depot                  =      $request->input('date_depot');
        $demandeur->nbre_piece                  =      $request->input('nombre_de_piece');
        $demandeur->niveau_etude                =      $request->input('niveau_etude');
        $demandeur->etablissement               =      $request->input('etablissement');
        $demandeur->telephone                   =      $autre_tel;
        $demandeur->fixe                        =      $fixe;
        $demandeur->option                      =      $request->input('option');
        $demandeur->adresse                     =      $request->input('adresse');
        $demandeur->motivation                  =      $request->input('motivation');
        $demandeur->autres_diplomes             =      $request->input('autres_diplomes');
        $demandeur->experience                  =      $request->input('experience');
        $demandeur->qualification               =      $request->input('qualification');
        $demandeur->communes_id                 =      $commune_id;
        if ($request->input('programme') !== null) {
            $demandeur->programmes_id           =      $programme_id;
        }
        $demandeur->types_demandes_id           =      $types_demandes_id;
        $demandeur->diplomes_id                 =      $diplome_id;
        $demandeur->users_id                    =      $utilisateur->id;

        $demandeur->save();

        if (!$user_connect->hasRole('Demandeur')) {
        $individuelle->statut                  =      $request->input('statut');
        }
        $individuelle->statut                   =      $statut;
        $individuelle->cin                      =     $cin;
        $individuelle->experience               =     $request->input('experience');
        $individuelle->information              =     $request->input('information');
        $individuelle->nbre_pieces              =     $request->input('nombre_de_piece');
        $individuelle->prerequis                =     $request->input('prerequis');
        $individuelle->demandeurs_id            =     $demandeur->id;

        $individuelle->save();
        $individuelle->modules()->sync($request->input('modules'));

        if (!$user_connect->hasRole('Demandeur')) {
            return redirect()->route('individuelles.index')->with('success', 'demande modifiée avec succès !');
        } else {
            return redirect()->route('profiles.show', ['user'=>$user_connect, 'user_connect'=>$user_connect])->with('success', 'votre demande modifiée avec succès !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Individuelle $individuelle)
    {
        $user = Auth::user();
        $utilisateurs   =   $individuelle->demandeur->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
        
        $individuelle->delete();

        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été supprimé(e)';

        if (!$user->hasRole('Demandeur')) {
            return redirect()->route('individuelles.index')->with('success', $message);
        } else {
            return redirect()->route('profiles.show', ['user'=>$user])->with('success', $message);
        }
    }

    public function list(Request $request)
    {
        $modules=Individuelle::with('demandeur.modules')->get();
        return Datatables::of($modules)->make(true);
    }
}
