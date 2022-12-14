<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Program;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @param Task $task
     * @return Response|bool
     */
    public function viewAny(?User $user, Task $task): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Task $task
     * @return Response|bool
     */
    public function view(?User $user, Task $task): Response|bool
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
        return auth()->user()->isAdmin() || auth()->user()->position_id == 5; //admins and Masters can
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(): Response|bool
    {
        return auth()->user()->isAdmin() || auth()->user()->position_id == 5; //admins and Masters can
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return Response|bool
     */
    public function delete(User $user, Task $task): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Task $task
     * @return Response|bool
     */
    public function restore(User $user, Task $task): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return Response|bool
     */
    public function forceDelete(User $user, Task $task): Response|bool
    {
        //
    }
}
