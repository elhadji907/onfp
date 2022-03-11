<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Projet;
use App\Models\Domaine;
use Illuminate\Http\Request;

class AgeroutemoduleController extends Controller
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

        $projets = Projet::find($projet_id);

        return view('ageroutemodules.index', compact('projets', 'projet_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $domaines = Domaine::get();

        return view('ageroutemodules.create', compact('domaines'));
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
        'module' => 'required|unique:modules,name',
        'domaine' => 'required',
        ]);

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $module = Module::create([
            'name'              => $request->input('module'),
            'domaines_id'       => $request->input('domaine')
        ]);

        $module->projets()->sync($projet_id);

        return redirect()->route('ageroutemodules.index')
            ->with('success', 'module créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::find($id);
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($projet_id);

        $domaines = Domaine::get();
        $domaine = $module->domaine;

        return view('ageroutemodules.update', compact('module', 'domaines', 'domaine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $module = Module::find($id);

        $this->validate($request, [
        'domaine'                         => 'required',
        'module'                             => 'required|unique:modules,name,'.$module->id
        ]);

        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $module->name               = $request->input('module');
        $module->domaines_id        = $request->input('domaine');

        $module->save();

        $module->projets()->sync($projet_id);

        return redirect()->route('ageroutemodules.index')
            ->with('success', 'Module modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
