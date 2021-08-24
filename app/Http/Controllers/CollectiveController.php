<?php

namespace App\Http\Controllers;

use App\Models\Collective;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Commune;
use App\Models\Region;
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

class CollectiveController extends Controller
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
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectives = Collective::all();
        $user = Auth::user();
        $user_connect = $user;
        $countries = DB::table('regions')->pluck("nom", "id");
        if (!$user->hasRole('Demandeur')) {
            return view('collectives.index', compact('collectives', 'countries'));
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

        $types_demande = $user->demandeur->types_demande->name;
        
        if (isset($user->demandeur->collectives) && $types_demande ==="Collective"
        && $user->hasRole('Demandeur') && !$user->hasRole('Administrateur')
        && !$user->hasRole('Gestionnaire') && !$user->hasRole('super-admin')) {
            $demandeurs = $user->demandeur;
            $collectives = $demandeurs->collectives;
        
            foreach ($collectives as $collective) {
            }
            return view('collectives.update', compact('civilites', 'collective', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'utilisateurs'));
        } elseif ($user->hasRole('super-admin') || $user->hasRole('Administrateur') || $user->hasRole('Gestionnaire')) {
            return view('collectives.create', compact('civilites', 'familiale', 'user', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot'));
        } else {
            return view('collectives.icreate', compact('civilites', 'user', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth::user();
        
        if (!$user->hasRole('Demandeur')) {
            $this->validate(
                $request,
                [
                    'sexe'                =>  'required|string|max:10',
                    'cin'                 =>  'required|string|min:13|max:15|unique:demandeurs,cin,'.$user->demandeur->id,
                    'name'                =>  'required|string|unique:collectives,name,NULL,id,deleted_at,NULL',
                    'prenom'              =>  'required|string|max:50',
                    'nom'                 =>  'required|string|max:50',
                    'date_naiss'          =>  'required|date_format:Y-m-d',
                    'date_depot'          =>  'required|date_format:Y-m-d',
                    'lieu_naissance'      =>  'required|string|max:50',
                    'telephone'           =>  'required|string|min:7|max:18',
                    'fixe'                =>  'required|string|min:7|max:18',
                    'structure_fixe'      =>  'required|string|min:7|max:18',
                    'adresse'             =>  'required|string|max:200',
                    'structure_adresse'   =>  'required|string|max:200',
                    'description'         =>  'required|string|min:1000|max:1500',
                    'email'               =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                    'professionnelle'     =>  'required',
                    'commune'             =>  'required',
                    'modules'             =>  'exists:modules,id',
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'sexe'                =>  'required|string|max:10',
                    'cin'                 =>  'required|string|min:13|max:15|unique:demandeurs,cin,'.$user->demandeur->id,
                    'name'                =>  'required|string|unique:collectives,name,NULL,id,deleted_at,NULL',
                    'prenom'              =>  'required|string|max:50',
                    'nom'                 =>  'required|string|max:50',
                    'date_naiss'          =>  'required|date_format:Y-m-d',
                    'date_depot'          =>  'required|date_format:Y-m-d',
                    'lieu_naissance'      =>  'required|string|max:50',
                    'telephone'           =>  'required|string|min:7|max:18',
                    'fixe'                =>  'required|string|min:7|max:18',
                    'structure_fixe'      =>  'required|string|min:7|max:18',
                    'adresse'             =>  'required|string|max:200',
                    'structure_adresse'   =>  'required|string|max:200',
                    'description'         =>  'required|string|min:1|max:1500',
                    'email'               =>  'required|string|email|max:255|unique:users,email,'.$user->id,
                    'professionnelle'     =>  'required',
                    'commune'             =>  'required',
                    'modules'             =>  'exists:modules,id',
                ]
            );
        }

        $user_id             =   User::latest('id')->first()->id;
        $demandeurs_id       =   Demandeur::latest('id')->first()->id;
        $username            =   $user->username;
        
        $annee = date('y');
        $demandeurs_id = Demandeur::latest('id')->first()->id;
        $longueur = strlen($demandeurs_id);

        if ($longueur <= 1) {
            $numero   =   "C".strtolower($annee."0000".$demandeurs_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "C".strtolower($annee."000".$demandeurs_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "C".strtolower($annee."00".$demandeurs_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "C".strtolower($annee."0".$demandeurs_id);
        } elseif ($longueur >= 5) {
            $numero   =   "C".strtolower($annee.$demandeurs_id);
        } else {
            $numero   =   "C".strtolower($annee.$demandeurs_id);
        }
       
        //$commune = commune::find($request->input('commune'));
        /*  $region = $commune->region->nom;
         $region_id = $commune->region->id; */

        $created_by1 = $user->firstname;
        $created_by2 = $user->name;
        $created_by3 = $username;

        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';

        $statut = "Attente";

        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);

        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);

        $structure_fixe = $request->input('structure_fixe');
        $structure_fixe = str_replace(' ', '', $structure_fixe);
       
        if ($request->input('programme') !== null) {
            $programme_id = Programme::where('sigle', $request->input('programme'))->first()->id;
        } else {
            $programme_id = null;
        }

        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        

        $types_demandes_id = TypesDemande::where('name', 'Collective')->first()->id;
        
        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        if (!$user->hasRole('Demandeur')) {
            $user = new User([
            'sexe'                          =>      $request->input('sexe'),
            'civilite'                      =>      $civilite,
            'firstname'                     =>      $request->input('prenom'),
            'name'                          =>      $request->input('nom'),
            'email'                         =>      $request->input('email'),
            'username'                      =>      $username,
            'telephone'                     =>      $telephone,
            'fixe'                          =>      $fixe,
            'bp'                            =>      $request->input('bp'),
            'fax'                           =>      $request->input('fax'),
            'situation_professionnelle'     =>      $request->input('professionnelle'),
            'date_naissance'                =>      $request->input('date_naiss'),
            'lieu_naissance'                =>      $request->input('lieu_naissance'),
            'adresse'                       =>      $request->input('adresse'),
            'password'                      =>      Hash::make($request->input('email')),
            'created_by'                    =>      $created_by,
            'updated_by'                    =>      $created_by

        ]);
    
            $user->save();
            $user->assignRole('Demandeur');
        } else {
            $updated_by1 = $user->firstname;
            $updated_by2 = $user->name;
            $updated_by3 = $user->username;

            $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')';
            
            $user->sexe                      =      $request->input('sexe');
            $user->civilite                  =      $civilite;
            $user->firstname                 =      $request->input('prenom');
            $user->name                      =      $request->input('nom');
            $user->email                     =      $request->input('email');
            $user->username                  =      $request->input('username');
            $user->telephone                 =      $telephone;
            $user->fixe                      =      $fixe;
            $user->bp                        =      $request->input('bp');
            $user->fax                       =      $request->input('fax');
            $user->situation_professionnelle =      $request->input('professionnelle');
            $user->date_naissance            =      $request->input('date_naiss');
            $user->lieu_naissance            =      $request->input('lieu_naissance');
            $user->adresse                   =      $request->input('adresse');
            $user->updated_by                =      $updated_by;
    
            $user->save();
        }

        $demandeur = new Demandeur([
            'numero'                        =>     $numero,
            'cin'                           =>     $cin,
            'numero_courrier'               =>     $numero,
            'date_depot'                    =>     $request->input('date_depot'),
            'telephone'                     =>     $autre_tel,
            'fixe'                          =>     $autre_tel,
            'statut'                        =>     $statut,
            'programmes_id'                 =>     $programme_id,
            'adresse'                       =>     $request->input('structure_adresse'),
            'description'                   =>     $request->input('description'),
            'experience'                    =>     $request->input('experience'),
            'communes_id'                   =>     $commune_id,
            'types_demandes_id'             =>     $types_demandes_id,
            'users_id'                      =>     $user->id
        ]);

        $demandeur->save();

        $collectives = new Collective([
            'name'              =>     $request->input('name'),
            'statut'            =>     $statut,
            'demandeurs_id'     =>     $demandeur->id
        ]);

        $collectives->save();

        $collectives->demandeur->modules()->sync($request->input('modules'));

        
        $user_connect  =  $user->demandeur;
        if (!$user->hasRole('Demandeur')) {
            return redirect()->route('collectives.index')->with('success', 'demandeur ajouté avec succès !');
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function show(Collective $collective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function edit(Collective $collective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collective $collective)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collective $collective)
    {
        //
    }
}
