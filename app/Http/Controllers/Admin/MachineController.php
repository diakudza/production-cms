<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MachineStoreRequest;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        return view('admin.machine', [
            'machines' => Machine::with('programs')->get(),
        ]);
    }

    public function store(MachineStoreRequest $request, Machine $machine)
    {
        $machine->fill($request->validated());
        $machine->save();
        return redirect()->back()->with('success', 'Оборудование добавлено!');
    }

    public function update(MachineStoreRequest $request, Machine $machine)
    {
        $validated = $request->validated();
        $validated['repair'] = $validated['repair'] ?? 0;
        $machine->update($validated);
        $machine->save();
        return redirect()->back()->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Machine $machine)
    {
        $machine->deleteOrFail();
        return redirect()->back()->with('success', 'Оборудование удалено!');
    }
}
