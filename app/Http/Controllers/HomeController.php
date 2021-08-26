<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Courrier;
use App\Models\Pcharge;
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
        $user_connect  =  $user->demandeur;

        if ($user->hasRole('Demandeur')) { 
            $courriers = $user->courriers;
        return view('profiles.show', compact('user','courriers','user_connect','demandeurs'));         
        } elseif ($user->hasRole('Nologin')) {
            return view('layout.404'); 
        }
        else {
        $courriers = Courrier::all();
        $annees = Pcharge::distinct('annee')->pluck('annee', 'annee'); 
        return view('courriers.index', compact('courriers','courrier', 'recues', 'internes', 'departs', 'annees'));      

        }
        
    }
}
