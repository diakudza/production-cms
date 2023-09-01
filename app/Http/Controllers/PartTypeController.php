<?php

namespace App\Http\Controllers;

use App\Models\PartType;
use App\Services\PartTypeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Repositories\PartTypeRepository;
use App\Http\Requests\Admin\PartTypeRequest;
use Illuminate\Contracts\Foundation\Application;

final class PartTypeController extends Controller
{

    public function __construct(
        private readonly PartTypeRepository $partTypeRepository,
        private readonly PartTypeService $partTypeService,
    ) {
    }

    public function index(): Application|Factory|View
    {
        return view('admin.partTypeList', ['partTypes' => $this->partTypeRepository->getAllPartType()]);
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
