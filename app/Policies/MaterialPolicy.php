<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Material;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @param Material $material
     * @return Response|bool
     */
    public function viewAny(?User $user, Material $material): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Material $material
     * @return Response|bool
     */
    public function view(?User $user, Material $material): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User|null $user
     * @return Response|bool
     */
    public function create(?User $user): Response|bool
    {
        return auth()->user()->isAdmin() || in_array(auth()->user()->position_id, [1,2]); //admins and Adjusters can
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function update(User $user, Material $material, Program $program): Response|bool
    {
        return auth()->user()->isAdmin() || auth()->user()->id == $program->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function delete(User $user, Material $material): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function restore(User $user, Material $material): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Material $material
     * @return Response|bool
     */
    public function forceDelete(User $user, Material $material): Response|bool
    {
        //
    }
}
