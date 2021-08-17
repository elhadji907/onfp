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
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'date_naissance'   => ['required', 'date'],
            'lieu_naissance'   => ['required', 'string', 'max:50'],
            'username' => ['required', 'string','min:5', 'max:10', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone'   => ['required','string','max:50'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       /*  $role_id = Role::where('name','Administrateur')->first()->id;
        $role = Role::where('name','Administrateur')->first()->name; */
        

        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'username' => $request->username,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            /* 'roles_id'  => $role_id, */
        ]);

        event(new Registered($user));

        $user->assignRole('Demandeur');
        $user->givePermissionTo('edit demandes', 'delete demandes');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
