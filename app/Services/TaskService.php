<?php

namespace App\Services;


use App\Models\Task;
use Carbon\Carbon;

final class TaskService
{
    public function store(array $data): bool
    {
        $task = new Task();

        return $task->fill($data)->save();
    }

    public function update(Task $task, array $data)
    {
        if (empty($data['inWork'])) {
            $data['inWork'] = 0;
        }

        if (!empty($data['completed'])) {
            $data['inWork'] = 0;
            $data['completed'] = 1;
            $data['dateCompleted'] = Carbon::now()->format('Y-m-d');
        }

        $task->update($data);
    }

    public function destroy()
    {
    }
}
