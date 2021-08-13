<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Courrier;
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


        $courriers = Courrier::all();


       // dd($couriers);

        //$operateurs = Operateur::get()->count();
        //$Personnels = Personnel::get()->count();


        $chart      = Courrier::all();

        /* $chart = new Courrierchart; */
    /*     $chart->labels(['Demandeurs', 'Courriers']);
        $chart->dataset('STATISTIQUES', 'bar', collect([$demandeurs, $courriers]))->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2", "#3cba9f", '#ff3838'],
        ]); */
        
        if (Auth::user()->hasRole('Administrateur') OR Auth::user()->hasRole('Gestionnaire')) {
           /*  return view('courriers.index', compact('courriers','courrier', 'recues', 'internes', 'departs','chart'));   */         
            return view('courriers.index', compact('courriers','courrier', 'recues', 'internes', 'departs'));           
        } else {
            
        $demandeurs = Demandeur::all();

        $user = auth::user();

        $user_connect  =  auth::user()->demandeur;


        return view('profiles.show', compact('user','courriers','user_connect','demandeurs'));

        }
        
    }
}
