<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\News;
use App\Models\Program;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @param News $news
     * @return Response|bool
     */
    public function viewAny(?User $user, News $news): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param News $news
     * @return Response|bool
     */
    public function view(?User $user, News $news): Response|bool
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
        return auth()->user() && auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param News $news
     * @return Response|bool
     */
    public function update(User $user, News $news): Response|bool
    {
        return auth()->user()->isAdmin() || auth()->user()->id == $news->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param News $news
     * @return Response|bool
     */
    public function delete(User $user, News $news): Response|bool
    {
        return auth()->user()->isAdmin() || auth()->user()->id == $news->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * @param User $user
     * @param News $news
     * @return Response|bool
     */
    public function restore(User $user, News $news): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param News $news
     * @return Response|bool
     */
    public function forceDelete(User $user, News $news): Response|bool
    {
        return auth()->user()->isAdmin() || auth()->user()->id == $news->user_id;
    }
}
