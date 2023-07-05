<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Machine;
use App\Services\MachineService;
use App\Http\Controllers\Controller;
use App\Repositories\ProgramRepository;
use App\Http\Requests\Admin\MachineStoreRequest;
use App\Http\Requests\Admin\MachineUpdateRequest;

final class MachineController extends Controller
{
    private readonly ProgramRepository $programRepository;
    private readonly MachineService $machineService;

    public function __construct(
        ProgramRepository $programRepository,
        MachineService $machineService
    ) {
        $this->programRepository = $programRepository;
        $this->machineService = $machineService;
    }

    public function index()
    {
        return view('admin.machine.machineList', [
            'machines' => Machine::with('programs')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.machine.machineAdd');
    }

    public function store(MachineStoreRequest $request, Machine $machine)
    {
        $this->machineService->store($machine, $request->validated());
        return redirect()
            ->route('admin.machine.index')
            ->with('success', 'Оборудование добавлено!');
    }

    public function show(Machine $machine)
    {
        $programs = $this->programRepository->getProgramsForMachine($machine->id);

        return view('admin.machine.machineSingle', [
            'machine' => $machine,
            'programs' => $programs,
        ]);
    }

    public function update(MachineUpdateRequest $request, Machine $machine)
    {
        $this->machineService->update($machine, $request->validated());

        return redirect()
            ->route('admin.machine.show', $machine->id)
            ->with('success', 'Оборудование обновлено!');
    }

    /**
     * @throws Throwable
     */
    public function destroy(Machine $machine)
    {
        $machine->deleteOrFail();
        return redirect()
            ->route('admin.machine.index')
            ->with('success', 'Оборудование удалено!');
    }
}
