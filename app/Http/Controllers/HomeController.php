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
        $demandeur  =  $user_connect->demandeur;
        $courriers = $user->courriers;

        if ($user->hasRole('Demandeur')) { 

        $individuelles  =  $demandeur->individuelles;
        $collectives  =  $demandeur->collectives;
        $pcharges  =  $demandeur->pcharges;


        foreach ($individuelles as $key => $individuelle) {
        }

        foreach ($collectives as $key => $collective) {
        }

        foreach ($pcharges as $key => $pcharge) {
        }

        return view('profiles.show', compact('user', 'courriers', 'individuelle', 'collective', 'pcharge'));         
        } 
        elseif ($user->hasRole('Individuelle') && $user->hasRole('Collective') && $user->hasRole('Pcharge')) {
            $individuelles  =  $demandeur->individuelles;
            foreach ($individuelles as $key => $individuelle) {
            }
            $collectives  =  $demandeur->collectives;
            foreach ($collectives as $key => $collective) {
            }
            $pcharges  =  $demandeur->pcharges;
            foreach ($pcharges as $key => $pcharge) {
            }
            return view('profiles.show', compact('user', 'courriers', 'individuelle', 'collective', 'pcharge'));  
        }
        elseif ($user->hasRole('Individuelle')) {
            $individuelles  =  $demandeur->individuelles;
            foreach ($individuelles as $key => $individuelle) {
            }
            return view('profiles.show', compact('user', 'courriers', 'individuelle'));  
        }
        elseif ($user->hasRole('Collective')) {
            $collectives  =  $demandeur->collectives;
            foreach ($collectives as $key => $collective) {
            }
            return view('profiles.show', compact('user', 'courriers', 'collective'));  
        }
        elseif ($user->hasRole('Pcharge')) {
            $pcharges  =  $demandeur->pcharges;
            foreach ($pcharges as $key => $pcharge) {
            }
            return view('profiles.show', compact('user', 'courriers', 'pcharge'));  
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
