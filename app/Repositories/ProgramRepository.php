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
}
