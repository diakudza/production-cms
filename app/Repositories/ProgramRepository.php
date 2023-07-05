<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

final class ProgramRepository
{
    public function getLastPrograms(int $count): Collection|array
    {
        return Program::query()
            ->OrderBy('created_at', 'desc')
            ->with('user')
            ->limit($count)
            ->get();
    }

    public function getProgramsForMachine(int $machineId): Collection|array
    {
        return Program::with(['user', 'machine'])
            ->whereRelation('machine', 'id', '=', $machineId)
            ->get();
    }
}
