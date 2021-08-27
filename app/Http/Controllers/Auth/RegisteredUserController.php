<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Permission;
use App\Rules\IsValidPassword;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            =>     'required|string|max:255',
            'firstname'       =>     'required|string|max:255',
            'date_naissance'  =>     'required|date',
            'lieu_naissance'  =>     'required|string|max:50',
            'username'        =>     'required|string|min:5|max:10|unique:users,username,NULL,id,deleted_at,NULL',
            'email'           =>     'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'telephone'       =>     'required|string|max:50',
            'password'        =>     'required|confirmed', Rules\Password::defaults(),
            /* 'password'        =>      ['required', 'string', 'confirmed', new isValidPassword()], */
        ]);

       /*  $role_id = Role::where('name','Administrateur')->first()->id;
        $role = Role::where('name','Administrateur')->first()->name; */
        

        $user = User::create([
            'name'              =>      $request->name,
            'firstname'         =>      $request->firstname,
            'date_naissance'    =>      $request->date_naissance,
            'lieu_naissance'    =>      $request->lieu_naissance,
            'username'          =>      $request->username,
            'telephone'         =>      $request->telephone,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
            'created_by'        =>      $request->firstname.' '.$request->name.' ('.$request->username.')',
            'updated_by'        =>      $request->firstname.' '.$request->name.' ('.$request->username.')',
            /* 'roles_id'  => $role_id, */
        ]);

        event(new Registered($user));

        $user->assignRole('Demandeur');

        /* $user->givePermissionTo('role-list');

        $user->givePermissionTo('demandeur-list');
        $user->givePermissionTo('demandeur-create');
        $user->givePermissionTo('demandeur-edit');
        $user->givePermissionTo('demandeur-delete');
        
        $user->givePermissionTo('operateur-list');
        $user->givePermissionTo('operateur-create');
        $user->givePermissionTo('operateur-edit');
        $user->givePermissionTo('operateur-delete'); */

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
