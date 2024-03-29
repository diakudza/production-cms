<?php

namespace App\Repositories;

use App\Actions\ImageAction;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_User_C;

final class UserRepository
{


    public function getUsers(): Collection|array
    {
        return User::with('shift', 'position')->get();
    }
    public function getAdjusterOnly(): array|Collection
    {
        return User::whereNotIn('position_id', [3, 4, 5])->OrderBy('name')->get();
    }

    public function lastLogins(User $user): object|null
    {
        return $user->logins()
            ->where('success','=', 1)
            ->OrderBy('created_at', 'DESC')
            ->first();
    }

    public function userPrograms(int $userId): Collection|array
    {
        return Program::with(['user', 'machine'])
            ->whereRelation('user', 'id', '=', $userId)
            ->OrderBy('partNumber')
            ->get();
    }

}
