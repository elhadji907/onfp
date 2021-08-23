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
        $countries = DB::table('regions')->pluck("nom","id");

        return view('collectives.index', compact('collectives', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $modules = Module::distinct('name')->get()->pluck('name','id')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('sigle','id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name','id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom','id')->unique();
        
        $date_depot = Carbon::now();

        $user = auth::user();
        
        $civilites = User::pluck('civilite','civilite');

        $date_depot = Carbon::now();

        if (isset(auth::user()->demandeur)) {
        $demandeurs = auth::user()->demandeur;
        $collectives = $demandeurs->collectives;
        
        foreach ($collectives as $collective) {
        }        
        $utilisateurs = $demandeurs->user;
        $civilites = User::pluck('civilite','civilite');
        $modules = Module::distinct('name')->get()->pluck('name','id')->unique();
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle','sigle')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name','name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom','nom')->unique();

        $date_depot = Carbon::now();

        return view('collectives.update',compact('civilites', 'collective', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'utilisateurs'));

        } else {
            $modules = Module::distinct('name')->get()->pluck('name','id')->unique();
            $programmes = Programme::distinct('sigle')->get()->pluck('sigle','sigle')->unique();
            $diplomes = Diplome::distinct('name')->get()->pluck('name','name')->unique();
            $communes = Commune::distinct('nom')->get()->pluck('nom','nom')->unique();
        return view('collectives.icreate',compact('civilites', 'user', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot'));
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
        //
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
