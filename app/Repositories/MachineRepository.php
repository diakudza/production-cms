<?php

namespace App\Repositories;

use App\Models\Machine;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class MachineRepository
{
    public function getAllMachines()
    {
        return Cache::remember('all_machines', 1800, function () {
            return Machine::all();
        });
    }
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
