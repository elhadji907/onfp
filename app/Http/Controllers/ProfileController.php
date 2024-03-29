<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Demandeur;
use App\Models\Professionnelle;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Familiale;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class ProfileController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        /* $individuelles    =      $user->demandeur->individuelles;
        $collectives      =      $user->demandeur->collectives;
        $pcharges         =      $user->demandeur->pcharges; */

        
        $recues = Recue::get()->count();
        $internes = Interne::get()->count();
        $departs = Depart::get()->count();
        $courrier = Courrier::get()->count();
        $demandeurs = Demandeur::get()->count();

        $chart      = Courrier::all();
        $user = Auth::user();
        $demandeurs = Demandeur::all();

        $demandeur  =  $user->demandeur;
        $courriers  = $user->courriers;
        
        $courrierss = Courrier::latest()->paginate(5);


        /* if ($user->hasRole('Ageroute')) {
            $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
            $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
            $projet = Projet::find($id);
            return view('agerouteindividuelles.index', compact('projet', 'projet_name'));
        } elseif ($user->hasRole('Demandeur')) {
            return view('profiles.show', compact('user', 'courriers'));
        } else {
            $courriers = Courrier::all();
            return view('courriers.index', compact('courriers', 'courrier', 'recues', 'internes', 'departs'));
        } */
        return view('profiles.show', compact('user', 'courriers', 'courrierss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* $this->authorize('update', $user->profile); */

        $civilites = User::select('civilite')->distinct()->get();
        /* $professionnelles = User::select('situation_professionnelle')->distinct()->get();
        $familiales = User::select('situation_familiale')->distinct()->get(); */
        
        $professionnelles = Professionnelle::distinct('name')->get()->pluck('name', 'name')->unique();

        $familiales = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();

        //dd($civilites);
        return view('profiles.edit', compact('user', 'civilites', 'professionnelles', 'familiales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /* $this->authorize('update', $user->profile); */
        
        $data = request()->validate([
            'civilite'              =>       ['required', 'string', 'max:50'],
            'firstname'             =>       ['required', 'string', 'max:50'],
            'name'                  =>       ['required', 'string', 'max:50'],
            'username'              =>       ['string', 'min:5', 'max:10', 'unique:users'],
            'email'                 =>       ['string', 'email', 'max:255', 'unique:users'],
            'date_naissance'        =>       ['required', 'date'],
            'fixe'                  =>       ['required'],
            'bp'                    =>       ['sometimes'],
            'fax'                   =>       ['sometimes'],
            'professionnelle'       =>       ['sometimes'],
            'familiale'             =>       ['sometimes'],
            'adresse'               =>       ['sometimes'],
            'lieu_naissance'        =>       ['required', 'string', 'max:50'],
            'telephone'             =>       ['required', 'string', 'max:50'],
            'image'                 =>       ['sometimes', 'file', 'max:2048']

        ]);

        if ($request->input('civilite') == "M.") {
            $sexe = "M";
        } elseif ($request->input('civilite') == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        if ($request->input('familiale') != null) {
            $familiale_id     = Familiale::where('name', $request->input('familiale'))->first()->id;
        } else {
            $familiale_id  = null;
        }

        if ($request->input('professionnelle') != null) {
            $professionnelle_id     = Professionnelle::where('name', $request->input('professionnelle'))->first()->id;
        } else {
            $professionnelle_id  = null;
        }
        
        if (request('image')) {
            $imagePath = request('image')->store('avatars', 'public');
        
            $file = $request->file('image');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Remove unwanted characters
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            // Get the original image extension
            $extension = $file->getClientOriginalExtension();
  
            // Create unique file name
            $fileNameToStore = 'avatars/'.$filename.''.time().'.'.$extension;
  
            //dd($fileNameToStore);

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
            $image->save();

            auth()->user()->profile->update([
            'image' => $imagePath
            ]);

            auth()->user()->update([
                'civilite'                      =>       $data['civilite'],
                'sexe'                          =>       $sexe,
                'firstname'                     =>       $data['firstname'],
                'name'                          =>       $data['name'],
                'date_naissance'                =>       $data['date_naissance'],
                'lieu_naissance'                =>       $data['lieu_naissance'],
                'telephone'                     =>       $data['telephone'],
                'fixe'                          =>       $data['fixe'],
                'bp'                            =>       $data['bp'],
                'adresse'                       =>       $data['adresse'],
                'familiales_id'                 =>       $familiale_id,
                'professionnelles_id'           =>       $professionnelle_id,
                'fax'                           =>       $data['fax']
            ]);
        } else {
            auth()->user()->profile->update($data);

            auth()->user()->update([
                'civilite'                      =>       $data['civilite'],
                'sexe'                          =>       $sexe,
                'firstname'                     =>       $data['firstname'],
                'name'                          =>       $data['name'],
                'date_naissance'                =>       $data['date_naissance'],
                'lieu_naissance'                =>       $data['lieu_naissance'],
                'telephone'                     =>       $data['telephone'],
                'fixe'                          =>       $data['fixe'],
                'bp'                            =>       $data['bp'],
                'adresse'                       =>       $data['adresse'],
                'familiales_id'                 =>       $familiale_id,
                'professionnelles_id'           =>       $professionnelle_id,
                'fax'                           =>       $data['fax']
                ]);
        }

        return redirect()->route('profiles.show', ['user'=>auth()->user()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
