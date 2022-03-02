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
            $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
            $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
            $projet = Projet::find($id);
            return view('agerouteindividuelles.index', compact('projet', 'projet_name'));
        } elseif ($user->hasRole('Demandeur')) {
            return view('profiles.show', compact('user', 'courriers'));
        } else {
            $courriers = Courrier::all();
            return view('courriers.index', compact('courriers', 'courrier', 'recues', 'internes', 'departs'));
        }
    }
}
