<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Courrier;
use App\Models\Pcharge;
use App\Models\Projet;
use App\Models\Individuelle;
use App\Models\Localite;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* $this->middleware('auth'); */
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $recues = Recue::get()->count();
        $internes = Interne::get()->count();
        $departs = Depart::get()->count();
        $courrier = Courrier::get()->count();
        $demandeurs = Demandeur::get()->count();

        $chart      = Courrier::all();
        $user = Auth::user();
        $demandeurs = Demandeur::all();

        $user_connect = Auth::user();
        $demandeur  =  $user_connect->demandeur;
        $courriers = $user->courriers;
        
        if ($user->hasRole('Ageroute')) {
            $id_projet = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
            $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
            $projet = Projet::find($id_projet);
            $individuelles = Individuelle::skip(0)->take(1000)->get();
    
            $ziguinchor_id = Localite::where('nom', 'Ziguinchor')->first()->id;
            $bignona_id = Localite::where('nom', 'Bignona')->first()->id;
            $bounkiling_id = Localite::where('nom', 'Bounkiling')->first()->id;
            
            $ziguinchor_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $ziguinchor_id)->count();
            $bignona_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bignona_id)->count();
            $bounkiling_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bounkiling_id)->count();
    
            $total_count = Individuelle::where('projets_id', '=', $id_projet)->count();
    
            $ziguinchor_p               =      ($ziguinchor_count / $total_count) * 100;
            $bignona_p                  =      ($bignona_count / $total_count) * 100;
            $bounkiling_p               =      ($bounkiling_count / $total_count) * 100;
            $total_p                    =      ($total_count / $total_count) * 100;
            
            $ziguinchor_p               =       round($ziguinchor_p, 2);
            $bignona_p                  =       round($bignona_p, 2);
            $bounkiling_p               =       round($bounkiling_p, 2);
         
            return view('agerouteindividuelles.index', compact('projet', 'projet_name', 'individuelles', 'ziguinchor_count', 'bignona_count', 'bounkiling_count', 'total_count', 'ziguinchor_p', 'bignona_p', 'bounkiling_p', 'total_p'));
        } elseif ($user->hasRole('Demandeur')) {
            return view('profiles.show', compact('user', 'courriers'));
        } else {
            $courriers = Courrier::all();
            return view('courriers.index', compact('courriers', 'courrier', 'recues', 'internes', 'departs'));
        }
    }
}
