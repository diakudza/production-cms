<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Machine;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Machine $machine
     * @return Application|Factory|View
     */
    public function index(Machine $machine): Application|Factory|View
    {
        $machines = $machine
            ->whereRelation('tasks', 'completed', false)
            ->with('tasks')->get();

        return view('public.taskAll', ['machines' => $machines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Machine $machine
     * @return Application|Factory|View
     */
    public function create(Machine $machine): Application|Factory|View
    {
        $machines = $machine->has('tasks')->with(['tasks' => function ($query) {
            $query->whereNot('completed', 1);
        }])->get();

        return view('public.taskAdd', ['machines' => $machines]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskStoreRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function store(TaskStoreRequest $request, Task $task): RedirectResponse
    {
        if ($task->fill($request->validated())->save()) {
            return redirect()->route('task.create', '#' . $request->input('machine_id'))
                ->with('success', 'Задание добавлено');
        }
        return redirect()
            ->route('task.show', $validated['taskStatus'] ?? NULL . '#' . $request->input('machine_id'))
            ->with('fail', 'Задание не добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param Machine $machine
     * @param string $param
     * @return Application|Factory|View
     */
    public function show(Machine $machine, string $param): Application|Factory|View
    {
        $bool = ($param == 'active') ? 0 : 1;

        $machines = $machine->has('tasks')->with(['tasks' => function ($query) use ($bool) {
            $query->where('completed', $bool);
        }])->get();

        return view('public.taskAdd', ['machines' => $machines]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(TaskStoreRequest $request, Task $task): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskStoreRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskStoreRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();
        if (empty($validated['inWork'])) {
            $validated['inWork'] = 0;
        }

        if (!empty($validated['completed'])) {
            $validated['inWork'] = 0;
            $validated['completed'] = 1;
            $validated['dateCompleted'] = Carbon::now()->format('Y-m-d');
        }

        $task->update($validated);

        return redirect()
            ->route('task.show', $validated['taskStatus'] ?? NULL . '#' . $request->input('machine_id'))
            ->with('success', 'Задание обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
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
