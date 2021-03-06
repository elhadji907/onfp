<?php

namespace App\Http\Controllers;

use App\Models\Depart;
use Illuminate\Http\Request;
use App\Models\TypesCourrier;
use Yajra\Datatables\Datatables;
use App\Models\Direction;
use App\Models\Imputation;
use Auth;
use App\Models\Courrier;
/* use App\Models\Charts\Courrierchart; */

use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class DepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    public function index()
    {
       $date = Carbon::today()->locale('fr_FR');
       $date = $date->copy()->addDays(0);
       $date = $date->isoFormat('LLLL'); // M/D/Y
       $recues = \App\Models\Recue::get()->count();
       $internes = \App\Models\Interne::get()->count();
       $departs = \App\Models\Depart::all();
       $courriers = \App\Models\Courrier::get()->count();
              
        return view('departs.index',compact('date','courriers', 'recues', 'internes', 'departs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypesCourrier::get();
        // $numCourrier = date('YmdHis').rand(1,99999);
        $numCourrier = date('YmdHis');

        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

        /* dd($date); */      
        $date_r = Carbon::now();
       
        return view('departs.create', compact('numCourrier', 'date', 'directions','imputations', 'date_r'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
                'objet'         =>  'required|string|max:200',
                'message'       =>  'required|string|max:255',
                'expediteur'    =>  'required|string|max:100',
                'adresse'       =>  'required|string|max:100',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255',
                'date_recep'    =>  'required|date',
                'date_cores'    =>  'required|date',
            ]
        );
        $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
        $user_id  = Auth::user()->id;
        $courrier_id = Courrier::get()->last()->id;
        $annee = date('Y');
        $numCourrier = $courrier_id;

        $direction = \App\Models\Direction::first();
        $imputation = \App\Models\Imputation::first();
        $courrier = \App\Models\Courrier::first();
        // $filePath = request('file')->store('recues', 'public');
        $courrier = new Courrier([
            'numero'             =>     "CD-".$annee."-".$numCourrier,
            'objet'              =>      $request->input('objet'),
            'message'            =>      $request->input('message'),
            'expediteur'         =>      $request->input('expediteur'),
            'telephone'          =>      $request->input('telephone'),
            'email'              =>      $request->input('email'),
            'adresse'            =>      $request->input('adresse'),
            'fax'                =>      $request->input('fax'),
            'bp'                 =>      $request->input('bp'),
            'date_recep'         =>      $request->input('date_recep'),
            'date_cores'         =>      $request->input('date_cores'),
            //'legende'          =>      $request->input('legende'),
            'types_courriers_id' =>      $types_courrier_id,
            'users_id'           =>      $user_id,
            'file'               =>      ""
        ]);

        $courrier->save();

        $depart = new Depart([
            'numero'        =>  "CD-".$annee."-".$numCourrier,
            'courriers_id'  =>   $courrier->id
        ]);
        
        $depart->save();
        
        //$courrier->directions()->sync($request->directions);
        $courrier->directions()->sync($request->imputations);
        
        return redirect()->route('departs.index')->with('success','courrier ajout?? avec succ??s !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function show(Depart $depart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function edit(Depart $depart)
    {
        
        $this->authorize('update',  $depart->courrier);

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

         return view('departs.update', compact('depart', 'directions','imputations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depart $depart)
    {

        $this->authorize('update',  $depart->courrier);

        $this->validate(
            $request, [
                'objet'         =>  'required|string|max:200',
                'message'       =>  'required|string|max:255',
                'expediteur'    =>  'required|string|max:100',
                'adresse'       =>  'required|string|max:100',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255',
                'date_recep'    =>  'required|date',
                'date_cores'    =>  'required|date',
                'file'          =>  'sometimes|required|file|max:30000|mimes:pdf,doc,txt,xlsx,xls,jpeg,jpg,jif,docx,png,svg,csv,rtf,bmp',

            ]
        );

       
    if (request('file')) { 
       $filePath = request('file')->store('departs', 'public');
       $courrier = $depart->courrier; 
       $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
       $user_id  = Auth::user()->id;

       $courrier->objet              =      $request->input('objet');
       $courrier->message            =      $request->input('message');
       $courrier->expediteur         =      $request->input('expediteur');
       $courrier->telephone          =      $request->input('telephone');
       $courrier->email              =      $request->input('email');
       $courrier->adresse            =      $request->input('adresse');
       $courrier->fax                =      $request->input('fax');
       $courrier->bp                 =      $request->input('bp');
       $courrier->date_recep         =      $request->input('date_recep');
       $courrier->date_cores         =      $request->input('date_cores');
       $courrier->legende            =      $request->input('legende');
       $courrier->types_courriers_id =      $types_courrier_id;
       $courrier->users_id           =      $user_id;
       $courrier->file               =      $filePath;

       $courrier->save(); 

       $depart->courriers_id          =      $courrier->id; 

       $depart->save();
       //$courrier->directions()->sync($request->input('directions'));
       $courrier->imputations()->sync($request->input('imputations'));
        }
         else{   
            $courrier = $depart->courrier;
            $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
            $user_id  = Auth::user()->id;
     
            $courrier->objet              =      $request->input('objet');
            $courrier->message            =      $request->input('message');
            $courrier->expediteur         =      $request->input('expediteur');
            $courrier->telephone          =      $request->input('telephone');
            $courrier->email              =      $request->input('email');
            $courrier->adresse            =      $request->input('adresse');
            $courrier->fax                =      $request->input('fax');
            $courrier->bp                 =      $request->input('bp');
            $courrier->date_recep         =      $request->input('date_recep');
            $courrier->date_cores         =      $request->input('date_cores');
            $courrier->legende            =      $request->input('legende');
            $courrier->types_courriers_id =      $types_courrier_id;
            $courrier->users_id   =      $user_id;
     
            $courrier->save();
     
            $depart->courriers_id          =      $courrier->id;
     
            $depart->save();
            //$courrier->directions()->sync($request->input('directions'));
            $courrier->imputations()->sync($request->input('imputations'));
 

         }

       return redirect()->route('courriers.show', $depart->courrier->id)->with('success','courrier modifi?? avec succ??s !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depart $depart)
    {

        $this->authorize('delete',  $depart->courrier);

        $depart->courrier->directions()->detach();
        $depart->courrier->imputations()->detach();
        $depart->courrier->delete();
        $depart->delete();
        
        $message = "Le courrier enregistr?? sous le num??ro ".$depart->numero.' a ??t?? supprim??';
        return redirect()->route('departs.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $date = Carbon::today();
        $date = $date->copy()->addDays(-7);

        $departs=Depart::with('courrier')->where('created_at', '>=', $date)->get();
        return Datatables::of($departs)->make(true);
    }

}
