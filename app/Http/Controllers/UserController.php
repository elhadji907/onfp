<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Demandeur']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      =   User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $civilites      =   User::select('civilite')->distinct()->get();
        $roles          =   Role::pluck('name','name')->all();
        return view('users.create',compact('civilites', 'roles'));
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
                'civilite'      =>  'required|string|max:10',
                'matricule'     =>  'required|string|max:50',
                'firstname'     =>  'required|string|max:50',
                'name'          =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255|unique:users,email',
                'username'      =>  'required|string|max:255|unique:users,username',
                'password'      =>  'required|confirmed|string|min:8|max:50',
            ],
            [
                'password.min'  =>  'Pour des raisons de sécurité, votre mot de passe doit faire au moins :min caractères.'
            ],
            [
                'password.max'  =>  'Pour des raisons de sécurité, votre mot de passe ne doit pas dépasser :max caractères.'
            ]
        );

        $utilisateur = new User([      
            'civilite'          =>      $request->input('civilite'),      
            'firstname'         =>      $request->input('prenom'),
            'name'              =>      $request->input('nom'),
            'email'             =>      $request->input('email'),
            'username'          =>      $request->input('username'),
            'telephone'         =>      $request->input('telephone'),
            'password'          =>      Hash::make($request->input('password')),

        ]);
        
        $utilisateur->save();
   
        return redirect()->route('administrateurs.index')->with('success','utilisateur ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* $roles = Role::pluck('name','name')->all(); */
        $userRole = $user->roles->pluck('name','name')->all();
        $roles = Role::distinct('name')->pluck('name','name')->unique();
        $civilites = User::distinct('civilite')->pluck('civilite','civilite')->unique();
       
        return view('users.update', compact('roles', 'civilites', 'userRole', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
