<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Demandeur;
use App\Models\Individuelle;
use App\Models\Collective;
use App\Models\Pcharge;
use App\Models\TypesDemande;
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
        
        $annee = date('y');
        $user_id             =      User::latest('id')->first()->id;
        $longueur            =      strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   strtolower($annee."000000".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   strtolower($annee."00000".$user_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   strtolower($annee."0000".$user_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   strtolower($annee."000".$user_id);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   strtolower($annee."00".$user_id);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   strtolower($annee."0".$user_id);
        } else {
            $numero   =   "I".strtolower($annee.$user_id);
        }

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

        $user->assignRole('Demandeur');
        
        $demandeur = Demandeur::create([
            'numero'            =>      $numero,
            'users_id'          =>      $user->id,
        ]);

        $individuelle = Individuelle::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);

        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;
        $demandeur->numero                    =     "I".$numero;
        $demandeur->statut                    =     "Attente";
        $demandeur->types_demandes_id         =     $types_demandes_id;

        $demandeur->save();

        $demandeur = Demandeur::create([
            'numero'            =>      $numero,
            'users_id'          =>      $user->id,
        ]);

        $collective = Collective::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);

        $types_demandes_id = TypesDemande::where('name', 'Collective')->first()->id;
        $demandeur->numero                    =     "C".$numero;
        $demandeur->statut                    =     "Attente";
        $demandeur->types_demandes_id         =     $types_demandes_id;

        $demandeur->save();

        $demandeur = Demandeur::create([
            'numero'            =>      $numero,
            'users_id'          =>      $user->id,
        ]);

        $pcharge = Pcharge::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);
        
        $types_demandes_id = TypesDemande::where('name', 'Prise en charge')->first()->id;
        $demandeur->numero                    =     "P".$numero;
        $demandeur->statut                    =     "Attente";
        $demandeur->types_demandes_id         =     $types_demandes_id;

        $demandeur->save();

        event(new Registered($user));

        /* $user->givePermissionTo('role-list');*/

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
