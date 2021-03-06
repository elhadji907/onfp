<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Demandeur;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandeurPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any demandeurs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the demandeur.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Demandeur  $demandeur
     * @return mixed
     */
    public function view(User $user, Demandeur $demandeur)
    {
        return $user->id === $demandeur->user->id;
    }

    /**
     * Determine whether the user can create demandeurs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the demandeur.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Demandeur  $demandeur
     * @return mixed
     */
    public function update(User $user, Demandeur $demandeur)
    {
        return $user->id === $demandeur->user->id;
    }

    /**
     * Determine whether the user can delete the demandeur.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Demandeur  $demandeur
     * @return mixed
     */
    public function delete(User $user, Demandeur $demandeur)
    {
        return $user->id === $demandeur->user->id;
    }

    /**
     * Determine whether the user can restore the demandeur.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Demandeur  $demandeur
     * @return mixed
     */
    public function restore(User $user, Demandeur $demandeur)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the demandeur.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Demandeur  $demandeur
     * @return mixed
     */
    public function forceDelete(User $user, Demandeur $demandeur)
    {
        //
    }
}
