<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user, Material $material)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Material $material)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        return auth()->user()->isAdmin() || in_array(auth()->user()->position_id, [1,2]); //admins and Adjusters can
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Material $material)
    {
        return auth()->user()->isAdmin() || auth()->user()->id == $program->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material $materialm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Material $material)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Material $material)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Material $material)
    {
        //
    }
}
