<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MachineStoreRequest;
use App\Http\Requests\Admin\MachineUpdateRequest;
use App\Models\Machine;
use App\Models\Program;
use Illuminate\Http\Request;

class MachineController extends Controller
{
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
        $machine->fill($request->validated());
        $machine->save();
        return redirect()->route('admin.machine.index')->with('success', 'Оборудование добавлено!');
    }

    public function show(Machine $machine)
    {

        $programs = Program::with(['user', 'machine'])
            ->whereRelation('machine', 'id', '=', $machine->id)
            ->get();

        return view('admin.machine.machineSingle', [
            'machine' => $machine,
            'programs' => $programs,
            ]);
    }

    public function update(MachineUpdateRequest $request, Machine $machine, ImageAction $imageAction)
    {
        $validated = $request->validated();
        $validated['repair'] = $validated['repair'] ?? 0;
        if (isset($validated['machinePhoto'])) {
            $validated['machinePhoto'] = $imageAction($validated['machinePhoto'], 'machines', 400, 400);
        }
        if (isset($validated['machinePhotoDelete'])) {
            $validated['machinePhoto'] = null;
        }
        $machine->update($validated);
        $machine->save();
        return redirect()->route('admin.machine.show', $machine->id)->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Machine $machine)
    {
        $machine->deleteOrFail();
        return redirect()->route('admin.machine.index')->with('success', 'Оборудование удалено!');
    }
}
