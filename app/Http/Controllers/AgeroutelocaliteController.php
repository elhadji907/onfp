<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use App\Models\Zone;
use App\Models\Projet;
use App\Models\Projetslocalite;
use Illuminate\Http\Request;
use DB;

class AgeroutelocaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projet = Projet::find($projet_id);

        return view('ageroutelocalites.index', compact('projet', 'projet_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ageroutelocalites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'nom' => 'required|unique:localites,nom',
        ]);

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        
        $localite = Localite::create(['nom' => $request->input('nom')]);
        $localite->projets()->sync($projet_id);

        return redirect()->route('ageroutelocalites.index')
            ->with('success', 'Département créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projet = Projet::find($projet_id);

        $localite = Localite::find($id);


        return view('ageroutelocalites.show', compact('projet', 'localite', 'projet_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localite = Localite::find($id);
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($projet_id);

        return view('ageroutelocalites.update', compact('localite', 'projet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'nom' => 'required|unique:localites,nom,'.$id
        ]);

        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $localite = Localite::find($id);
        $localite->nom = $request->input('nom');
        $localite->projets()->sync($projet_id);
        $localite->save();

        return redirect()->route('ageroutelocalites.index')
            ->with('success', 'Département modifié avec succès');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $localite = Localite::find($id);
        $localite->projets()->detach($projet_id);
        DB::table("localites")->where('id', $id)->delete();
        /* $localite->delete(); */
        return redirect()->route('ageroutelocalites.index')
->with('success', 'Département supprimé avec succès');
    }

    public function listerparlocalite($projet, $localite)
    {
        $projet = Projet::find($projet);
        
        return view('agerouteindividuelles.listerparlocalite', compact('projet', 'localite'));
    }

    public function candidatlocalite($projet, $localite)
    {
        $projet = Projet::find($projet);
        
        return view('ageroutelocalites.candidatlocalite', compact('projet', 'localite'));
    }
}
