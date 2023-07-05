<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Material;
use App\Services\MaterialService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaterialStoreRequest;

final class MaterialController extends Controller
{
    private readonly MaterialService $materialService;

    public function __construct(
        MaterialService $materialService,
    ) {
        $this->materialService = $materialService;
    }
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
        $this->materialService->store($material, $request->validated() );

        return redirect()
            ->route('admin.material.index')
            ->with('success', "Материал $material->title добавлен");
    }

    public function update(MaterialStoreRequest $request, Material $material)
    {
        $this->materialService->update($material, $request->validated());

        return redirect()->back()->with('success', 'Материал обновлен!');
    }

    /**
     * @throws Throwable
     */
    public function destroy(Material $material)
    {
        $material->deleteOrFail();
        return redirect()
            ->route('admin.material.index')
            ->with('success', 'Материал удален!');
    }
}
