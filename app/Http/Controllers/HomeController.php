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

        $user_connect = Auth::user();
        $user_user  =  $user_connect->demandeur;
        $courriers = $user->courriers;

        if ($user->hasRole('Demandeur')) { 

        $individuelle_users  =  $user_user->individuelles;
        $collective_users  =  $user_user->collectives;
        $pcharge_users  =  $user_user->pcharges;


        foreach ($individuelle_users as $key => $individuelle_user) {
        }

        foreach ($collective_users as $key => $collective_user) {
        }

        foreach ($pcharge_users as $key => $pcharge_user) {
        }

        return view('profiles.show', compact('user', 'courriers', 'demandeurs', 'individuelle_user', 'collective_user', 'pcharge_user'));         
        } 
        elseif ($user->hasRole('Individuelle')) {
            $individuelle_users  =  $user_user->individuelles;
            foreach ($individuelle_users as $key => $individuelle_user) {
            }
            return view('profiles.show', compact('user', 'courriers', 'demandeurs', 'individuelle_user'));  
        }
        elseif ($user->hasRole('Collective')) {
            $collective_users  =  $user_user->collectives;
            foreach ($collective_users as $key => $collective_user) {
            }
            return view('profiles.show', compact('user', 'courriers', 'demandeurs', 'collective_user'));  
        }
        elseif ($user->hasRole('Pcharge')) {
            $pcharge_users  =  $user_user->pcharges;
            foreach ($pcharge_users as $key => $pcharge_user) {
            }
            return view('profiles.show', compact('user', 'courriers', 'demandeurs', 'pcharge_user'));  
        }
        elseif ($user->hasRole('Nologin')) {
            return view('layout.404'); 
        }
        else {
        $courriers = Courrier::all();

        $pcharges = Pcharge::distinct('scolarites_id')->pluck('annee', 'annee'); 
        return view('courriers.index', compact('courriers','courrier', 'recues', 'internes', 'departs', 'pcharges'));      

        }
        
    }
}
