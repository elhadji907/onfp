<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Charts\Courrierchart;
use Illuminate\Notifications\DatabaseNotification;

class CourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('roles:Administrateur|Gestionnaire|Courrier'); */
    }
    public function index()
    {

        $recues = \App\Models\Recue::get()->count();
        $internes = \App\Models\Interne::get()->count();
        $departs = \App\Models\Depart::get()->count();
        $bordereaus = \App\Models\Bordereau::get()->count();
        $facturesdafs = \App\Models\Facturesdaf::get()->count();
        $tresors = \App\Models\Tresor::get()->count();
        $banques = \App\Models\Banque::get()->count();

        $courrier = Courrier::get()->count();
        
        $courriers = Courrier::all();

     /*    $chart      = Courrier::all();

        $chart = new Courrierchart;
        $chart->labels(['Courriers départs', 'Courriers arrivés', 'Courriers internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$internes, $recues, $departs])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        
        return view('courriers.index', compact('courriers','courrier', 'recues', 'internes', 'departs', 'bordereaus','facturesdafs','tresors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recues = \App\Models\Recue::get()->count();
        $internes = \App\Models\Interne::get()->count();
        $departs = \App\Models\Depart::get()->count();       
        $courriers = Courrier::get()->count();
        $demandes = \App\Models\Demandeur::get()->count();
        $bordereaus = \App\Models\Bordereau::get()->count();
        $facturesdafs = \App\Models\Facturesdaf::get()->count();        
        $tresors = \App\Models\Tresor::get()->count();
        $banques = \App\Models\Banque::get()->count();



        return view('courriers.create', compact('courriers', 'recues', 'demandes', 'internes', 'departs', 'bordereaus','facturesdafs','tresors'));
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
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function show(Courrier $courrier)
    {        
        $typescourrier = $courrier->types_courrier->name;
       // dd($typescourrier); 

        $recues = $courrier->recues;
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;        
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;

        $chart      = Courrier::all();

        
        $recue = \App\Models\Recue::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count();

    /*     $chart = new Courrierchart;
        $chart->labels(['Départs', 'Arrivés', 'Internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        if ($typescourrier == 'Courriers arrives') {            
        return view('recues.show', compact('recues','courrier'));

        } elseif($typescourrier == 'Courriers departs') {   
        return view('departs.show', compact('departs','courrier'));

        } elseif($typescourrier == 'Courriers internes') {    
            return view('internes.show', compact('internes','courrier'));

        } elseif($typescourrier == 'Bordereau') {    
            return view('bordereaus.show', compact('bordereaus','courrier'));

        } elseif($typescourrier == 'Tresors') {    
            return view('tresors.show', compact('tresors','courrier'));

        } elseif($typescourrier == 'Factures daf') {    
            return view('facturesdafs.show', compact('facturesdafs','courrier'));

        }  elseif($typescourrier == 'Banques') {    
            return view('banques.show', compact('banques','courrier'));
    
        }else {
            return view('courriers.show', compact('courrier'));
        }
        
    }


    public function showFromNotification(Courrier $courrier, DatabaseNotification $notification){

        $notification->markAsRead();
        
        $typescourrier = $courrier->types_courrier->name;
        $recues = $courrier->recues;
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;
        // $demandes = $courrier->demandeurs;
        
        $recue = \App\Models\Recue::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count();

        $chart      = Courrier::all();

     /*    $chart = new Courrierchart;
        $chart->labels(['Départs', 'Arrivés', 'Internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        // dd($typescourrier);
        if ($typescourrier == 'Courriers arrives') {            
            return view('recues.show', compact('recues','courrier'));
    
            } elseif($typescourrier == 'Courriers departs') {   
            return view('departs.show', compact('departs','courrier'));
    
            } elseif($typescourrier == 'Courriers internes') {    
                return view('internes.show', compact('internes','courrier'));
    
            }  
            elseif($typescourrier == 'Bordereau') {    
                return view('bordereaus.show', compact('bordereaus','courrier'));
    
            }  
            elseif($typescourrier == 'Factures daf') {    
                return view('facturesdafs.show', compact('facturesdafs','courrier'));
    
            }  
            elseif($typescourrier == 'Tresors') {    
                return view('tresors.show', compact('tresors','courrier'));
    
            }  elseif($typescourrier == 'Banques') {    
                return view('banques.show', compact('banques','courrier'));
        
            }else {
                return view('courriers.show', compact('courrier'));
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Courrier $courrier)
    {
    //    dd($courrier);
    $typescourrier = $courrier->types_courrier->name;
    //dd($typescourrier);

    $recues = $courrier->recues;
    $departs = $courrier->departs;
    $internes = $courrier->internes;
    $bordereaus = $courrier->bordereaus;
    $facturesdafs = $courrier->facturesdafs;
    $tresors = $courrier->tresors;
    $banques = $courrier->banques;
    
    $recue = \App\Models\Recue::get()->count();
    $interne = \App\Models\Interne::get()->count();
    $depart = \App\Models\Depart::get()->count();

    $chart      = Courrier::all();

/*     $chart = new Courrierchart;
    $chart->labels(['Départs', 'Arrivés', 'Internes']);
    $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
        'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
    ]); */

    if ($typescourrier == 'Courriers arrives') {            
    return view('recues.details', compact('recues','courrier'));

    } elseif($typescourrier == 'Courriers departs') {   
    return view('departs.details', compact('departs','courrier'));

    } elseif($typescourrier == 'Courriers internes') {    
        return view('internes.details', compact('internes','courrier'));

    }  elseif($typescourrier == 'Bordereau') {    
        return view('bordereaus.details', compact('bordereaus','courrier'));

    } elseif($typescourrier == 'Factures daf') {    
        return view('facturesdafs.details', compact('facturesdafs','courrier'));

    }   elseif($typescourrier == 'Tresors') {    
        return view('tresors.details', compact('tresors','courrier'));

    }   elseif($typescourrier == 'Banques') {    
        return view('banques.details', compact('banques','courrier'));

    }else {
        return view('courriers.details', compact('courrier'));
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courrier $courrier)
    {
        $this->authorize('update', $courrier);
        dd($courrier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courrier $courrier)
    {
        //
    }

    public function list(Request $request)
    {
        $courriers=Courrier::with('types_courrier')->get();
        return Datatables::of($courriers)->make(true);
        
    }
}
