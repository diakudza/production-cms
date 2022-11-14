<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaterialStoreRequest;
use App\Http\Requests\Admin\ShiftStoreRequest;
use App\Http\Requests\Admin\ShiftUpdateRequest;
use App\Models\Material;
use App\Models\Shift;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        return view('admin.materialList', [
            'materials' => Material::OrderBy('title')->get(),
            'colors' => config('colors'),
        ]);
    }

    public function create()
    {
        return view('admin.materialAdd');
    }

    public function edit(Material $material)
    {
        return view('admin.materialSingle', [
            'material' => $material,
        ]);
    }

    public function store(MaterialStoreRequest $request, Material $material)
    {
        $validated = $request->validated();
        if ($validated['color'] && $validated['colorAdd']) {
            $validated['color'] = $validated['color'] . ',' . $validated['colorAdd'];
        }
        $material->fill($validated);
        $material->save();
        return redirect()->route('admin.material.index')->with('success', "Материал $material->title добавлен");
    }

    public function update(MaterialStoreRequest $request, Material $material)
    {
        $validated = $request->validated();
        if ($validated['color'] && $validated['colorAdd']) {
            $validated['color'] = $validated['color'] . ',' . $validated['colorAdd'];
        }
        $material->update($validated);
        $material->save();
        return redirect()->back()->with('success', 'Материал обновлен!');
    }

    public function destroy(Material $material)
    {
        $material->deleteOrFail();
        return redirect()->route('admin.material.index')->with('success', 'Материал удален!');
    }
}
