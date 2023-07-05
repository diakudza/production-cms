<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Repositories\MachineRepository;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Contracts\Foundation\Application;

final class TaskController extends Controller
{
    private MachineRepository $machineRepository;
    private TaskService $taskService;

    public function __construct(
        MachineRepository $machineRepository,
        TaskService $taskService
    ) {
        $this->machineRepository = $machineRepository;
        $this->taskService = $taskService;
    }

    public function index(): Application|Factory|View
    {
        $machines = $this->machineRepository->getMachineWithActiveTask();

        return view('public.taskAll', ['machines' => $machines]);
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {
        $task = $this->taskService->store($request->validated());

        $withArray = ['success', 'Задание добавлено'];
        $route = 'task.create';
        $parameters = '#' . $request->input('machine_id');

        if (!$task) {
            $withArray = ['fail', 'Задание не добавлено'];
            $route = 'task.show';
            $parameters = $validated['taskStatus'] ?? null . '#' . $request->input('machine_id');
        }

        return redirect()->route($route, $parameters)->with($withArray);
    }

    public function show(string $param): Application|Factory|View
    {
        $bool = ($param == 'active') ? 0 : 1;

        $machines = $this->machineRepository->getMachineByStatus($bool);

        return view('public.taskAdd', ['machines' => $machines]);
    }

    public function update(TaskStoreRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();

        $this->taskService->update($task, $validated);

        return redirect()
            ->route('task.show', $validated['taskStatus'] ?? null . '#' . $request->input('machine_id'))
            ->with('success', 'Задание обновлено');
    }

    /**
     * @throws Throwable
     */
    public function destroy(string $taskStatus, Task $task): RedirectResponse
    {
        $task->deleteOrFail();
        return redirect()
            ->route('task.show', $taskStatus)
            ->with('success', 'Задание удалено!');
    }
}
