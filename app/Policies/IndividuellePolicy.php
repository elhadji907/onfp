<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Individuelle;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndividuellePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any individuelles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the individuelle.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Individuelle  $individuelle
     * @return mixed
     */
    public function view(User $user, Individuelle $individuelle)
    {
        return $user->id === $individuelle->demandeur->user->id;
    }

    /**
     * Determine whether the user can create individuelles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the individuelle.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Individuelle  $individuelle
     * @return mixed
     */
    public function update(User $user, Individuelle $individuelle)
    {
        return $user->id === $individuelle->demandeur->user->id;
    }

    /**
     * Determine whether the user can delete the individuelle.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Individuelle  $individuelle
     * @return mixed
     */
    public function delete(User $user, Individuelle $individuelle)
    {
        return $user->id === $individuelle->demandeur->user->id;
    }

    /**
     * Determine whether the user can restore the individuelle.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Individuelle  $individuelle
     * @return mixed
     */
    public function restore(User $user, Individuelle $individuelle)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the individuelle.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Individuelle  $individuelle
     * @return mixed
     */
    public function forceDelete(User $user, Individuelle $individuelle)
    {
        //
    }
}
