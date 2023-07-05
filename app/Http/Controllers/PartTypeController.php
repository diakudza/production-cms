<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PartTypeRequest;
use App\Models\PartType;
use App\Repositories\PartTypeRepository;
use App\Services\PartTypeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class PartTypeController extends Controller
{
    private PartTypeService $partTypeService;
    private PartTypeRepository $partTypeRepository;
    public function __construct(
        PartTypeRepository $partTypeRepository,
        PartTypeService $partTypeService,
    ) {
        $this->partTypeService = $partTypeService;
        $this->partTypeRepository = $partTypeRepository;
    }
    public function index(): Application|Factory|View
    {
        $partTypes = $this->partTypeRepository->getAllPartType();

        return view('admin.partTypeList', compact('partTypes'));
    }

    public function store(PartTypeRequest $request, PartType $partType): RedirectResponse
    {

        $result = $this->partTypeService->store($request->validated());

        if ($result) {
            return redirect()->back()->with('success', "Запись $partType->title добавлена");
        }
        return redirect()->back()->with('fail', "Ошибка при добавлении");
    }


    public function update(PartTypeRequest $request, PartType $partType): RedirectResponse
    {
        $result = $this->partTypeService->update($partType->id, $request->validated());

        if ($result) {
            return redirect()->back()->with('success', "запись $partType->title обновлена");
        }
        return redirect()->back()->with('fail', "Ошибка при обновлении");
    }

    public function destroy(PartType $partType): RedirectResponse
    {
        $result = $this->partTypeService->destroy($partType->id);

        if ($result) {
            return redirect()->back()->with('success', "запись $partType->title удалена");
        }
        return redirect()->back()->with('fail', "Ошибка при удалении");
    }
}
