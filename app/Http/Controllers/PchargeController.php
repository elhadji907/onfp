<?php

namespace App\Http\Controllers;

use App\Models\Pcharge;
use App\Models\Etablissement;
use App\Models\Filiere;
use App\Models\Filierespecialite;
use App\Models\TypesDemande;
use App\Models\Commune;
use App\Models\Diplome;
use App\Models\Module;
use App\Models\User;
use App\Models\Demandeur;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use DB;

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

        $an2019 = Pcharge::where('annee', '2019')->count();
        $an2020 = Pcharge::where('annee', '2020')->count();
        $an2021 = Pcharge::where('annee', '2021')->count();
        $an2022 = Pcharge::where('annee', '2022')->count();

        /* $total = Pcharge::get()->count(); */

        $total = DB::table('pcharges')->whereBetween('annee', array(2018, 2021))->get()->count();

        /* dd($total); */

        $depart = "2018";
        $enCours = date('Y');

        $pcharges      =   Pcharge::whereBetween('annee', array($depart, $enCours))->get();

        /* dd($pcharges); */

        return view('pcharges.index', compact('pcharges', 'annees', 'total', 'an2019', 'an2020', 'an2021', 'an2022', 'depart', 'enCours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $etablissement_id = $request->input('etablissement');
        
        $etablissement = Etablissement::find($etablissement_id);

        $etablissements = Etablissement::distinct('name')->get()->pluck('name', 'name')->unique();
        $filieres = Filiere::distinct('name')->get()->pluck('name', 'id')->unique();
        $filierespecialites = Filierespecialite::distinct('name')->get()->pluck('name', 'id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();

        $enCours = date('Y');
        $date_depot = Carbon::now();

        return view('pcharges.create', compact('etablissements', 'filieres', 'enCours', 'etablissement', 'date_depot', 'filierespecialites', 'diplomes'));
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
        
        $pcharges = $user_connect->demandeur->pcharges;

        $this->validate($request, [
                'annee'                 =>  'required|string|min:4|max:4',
                'cin'                   =>  'required|string|min:12|max:14',
                'civilite'              =>  'required|string',
                'firstname'             =>  'required|string|max:50',
                'name'                  =>  'required|string|max:50',
                'telephone'             =>  'required|string|max:50',
                'email'                 =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                'adresse'               =>  'required|string',
                'fixe'                  =>  'required|string|max:50',
                'date'                  =>  'required|date',
                'lieu_naissance'        =>  'required|string|max:50',
                'etablissement'         =>  'required|exists:etablissements,id',
                'filiere'               =>  'required|exists:filieres,id',
                'familiale'             =>  'required',
                'professionnelle'       =>  'required',
                'niveau_etude'          =>  'required',
                'inscription'           =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'montant'               =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'duree'                 =>  'required|min:1|max:1',
                'niveauentree'          =>  'required',
                'niveausortie'          =>  'required',
                'motivation'            =>  'required',
                'diplome'               =>  'required',
                'typedemande'           =>  'required',
            ]);

        $etablissement_id = $request->input('etablissement');
        $etablissement = Etablissement::find($etablissement_id);

        $user_id             =   User::latest('id')->first()->id;
        if (!$user_connect->hasRole('Demandeur')) {
            $username            =   strtolower($request->input('name').$user_id);
        } else {
            $username            =   $user_connect->username;
        }

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
    
        $created_by1 = $user_connect->firstname;
        $created_by2 = $user_connect->name;
        $created_by3 = $user_connect->username;
    
        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';
    
        $statut = "Attente";
    
        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
    
        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);
            
        $diplome_id = Diplome::where('name', $request->input('diplome'))->first()->id;
        $commune_id = $etablissement->commune->id;
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);

        $types_demandes_id = TypesDemande::where('name', 'Prise en charge')->first()->id;
        
        if ($request->input('civilite') == "M.") {
            $sexe = "M";
        } elseif ($request->input('civilite') == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        $typedemande = $request->input('typedemande');

        if ($typedemande !== "Renouvellement") {
            $user = new User([
            'sexe'                      =>      $sexe,
            'civilite'                  =>      $request->input('civilite'),
            'firstname'                 =>      $request->input('firstname'),
            'name'                      =>      $request->input('name'),
            'email'                     =>      $request->input('email'),
            'username'                  =>      $username,
            'telephone'                 =>      $telephone,
            'fixe'                      =>      $fixe,
            'bp'                        =>      $request->input('bp'),
            'fax'                       =>      $request->input('fax'),
            'situation_familiale'       =>      $request->input('familiale'),
            'situation_professionnelle' =>      $request->input('professionnelle'),
            'date_naissance'            =>      $request->input('date'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'adresse'                   =>      $request->input('adresse'),
            'password'                  =>      Hash::make($request->input('email')),
            'created_by'                =>      $created_by,
            'updated_by'                =>      $created_by

        ]);
    
            $user->save();
            $user->assignRole('Pcharge');
            
            $demandeur = new Demandeur([
                'numero'                    =>     $numero,
                'date_depot'                =>     $request->input('date_depot'),
                'nbre_piece'                =>     $request->input('nombre_de_piece'),
                'niveau_etude'              =>     $request->input('niveau_etude'),
                'telephone'                 =>     $telephone,
                'fixe'                      =>     $fixe,
                'adresse'                   =>     $request->input('adresse'),
                'motivation'                =>     $request->input('motivation'),
                'communes_id'               =>     $commune_id,
                'types_demandes_id'         =>     $types_demandes_id,
                'diplomes_id'               =>     $diplome_id,
                'users_id'                  =>     $user->id
            ]);
    
            $demandeur->save();
    
            $pcharge = new Pcharge([
                'annee'                     =>      $request->input('annee'),
                'cin'                       =>      $request->input('cin'),
                'duree'                     =>      $request->input('duree'),
                'inscription'               =>      $request->input('inscription'),
                'montant'                   =>      $request->input('montant'),
                'niveauentree'              =>      $request->input('niveauentree'),
                'niveausortie'              =>      $request->input('niveausortie'),
                'specialisation'            =>      $request->input('specialite'),
                'typedemande'               =>      $request->input('typedemande'),
                'statut'                    =>      "Attente",
                'etablissements_id'         =>      $request->input('etablissement'),
                'filieres_id'               =>      $request->input('filiere'),
                'demandeurs_id'             =>      $demandeur->id
    
            ]);
    
            $pcharge->save();

            return redirect()->route('pcharges.index')->with('success', 'renouvellement enregistré avec succès !');
        } else {
            $user_connect = Auth::user();
            $demandeur = $user_connect->demandeur;
            $statut = "Attente";
           
            $user_connect->sexe                         =      $sexe;
            $user_connect->civilite                     =      $request->input('civilite');
            $user_connect->firstname                    =      $request->input('firstname');
            $user_connect->name                         =      $request->input('name');
            $user_connect->email                        =      $request->input('email');
            $user_connect->username                     =      $username;
            $user_connect->telephone                    =      $telephone;
            $user_connect->fixe                         =      $fixe;
            $user_connect->bp                           =      $request->input('bp');
            $user_connect->fax                          =      $request->input('fax');
            $user_connect->situation_familiale          =      $request->input('familiale');
            $user_connect->situation_professionnelle    =      $request->input('professionnelle');
            $user_connect->date_naissance               =      $request->input('date');
            $user_connect->lieu_naissance               =      $request->input('lieu_naissance');
            $user_connect->adresse                      =      $request->input('adresse');
            $user_connect->password                     =      Hash::make($request->input('email'));
            $user_connect->created_by                   =      $created_by;
            $user_connect->updated_by                   =      $created_by;

            $user_connect->save();
                
            $demandeur->numero                          =     $numero;
            $demandeur->nbre_piece                      =     $request->input('nombre_de_piece');
            $demandeur->niveau_etude                    =     $request->input('niveau_etude');
            $demandeur->telephone                       =     $telephone;
            $demandeur->fixe                            =     $fixe;
            $demandeur->adresse                         =     $request->input('adresse');
            $demandeur->motivation                      =     $request->input('motivation');
            $demandeur->communes_id                     =     $commune_id;
            $demandeur->types_demandes_id               =     $types_demandes_id;
            $demandeur->diplomes_id                     =     $diplome_id;
            $demandeur->users_id                        =     $user_connect->id;

            $demandeur->save();

            $pcharge = new Pcharge([
                'annee'                     =>      $request->input('annee'),
                'cin'                       =>      $request->input('cin'),
                'duree'                     =>      $request->input('duree'),
                'inscription'               =>      $request->input('inscription'),
                'montant'                   =>      $request->input('montant'),
                'niveauentree'              =>      $request->input('niveauentree'),
                'niveausortie'              =>      $request->input('niveausortie'),
                'specialisation'            =>      $request->input('specialite'),
                'typedemande'               =>      $request->input('typedemande'),
                'date_depot'                =>      $request->input('date_depot'),
                'statut'                    =>      "Attente",
                'etablissements_id'         =>      $request->input('etablissement'),
                'filieres_id'               =>      $request->input('filiere'),
                'demandeurs_id'             =>      $demandeur->id
    
            ]);
            
            return redirect()->route('pcharges.index')->with('success', 'nouvelle demande enregistrée avec succès !');
        }
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
