<?php

namespace App\Repositories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Collection;

final class MachineRepository
{
    public function getMachineWithActiveTask(): Collection
    {
        return Machine::query()
            ->whereRelation('tasks', 'completed', false)
            ->with('tasks')->get();
    }

    public function getMachineByStatus(bool $bool): Collection
    {
        return Machine::query()
            ->has('tasks')->with([
                'tasks' => function ($query) use ($bool) {
                    $query->where('completed', $bool);
                }
            ])->get();
    }
}
