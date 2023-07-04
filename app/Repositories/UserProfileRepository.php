<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

final class UserProfileRepository
{
    public function favMachines(int $userId): Collection|array
    {
        return Program::query()
            ->join('machines', 'machines.id', '=', 'programs.machine_id')
            ->selectRaw('count(machine_id) as count, machines.title, machines.id')
            ->where('user_id', $userId)
            ->groupBy('machine_id')
            ->orderByDesc('count')
            ->get();
    }

    public function userPrograms(int $userId): Collection|array
    {
        return Program::with(['user', 'machine'])
            ->whereRelation('user', 'id', '=', $userId)
            ->get();
    }
}
