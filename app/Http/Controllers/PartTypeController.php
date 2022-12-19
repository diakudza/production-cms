<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PartTypeRequest;
use App\Models\PartType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PartTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $partTypes = PartType::select('id', 'title')->OrderBy('title')->get();
        return view('admin.partTypeList', compact('partTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PartTypeRequest $request
     * @param PartType $partType
     * @return RedirectResponse
     */
    public function store(PartTypeRequest $request, PartType $partType): RedirectResponse
    {
        if ($partType->fill($request->validated())->save()) {
            return redirect()->back()->with('success', "Запись $partType->title добавлена");
        }
        return redirect()->back()->with('fail', "Ошибка при добавлении");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartTypeRequest $request
     * @param PartType $partType
     * @return RedirectResponse
     */
    public function update(PartTypeRequest $request, PartType $partType): RedirectResponse
    {
        if ($partType->update($request->validated())) {
            return redirect()->back()->with('success', "запись $partType->title обновлена");
        }
        return redirect()->back()->with('fail', "Ошибка при обновлении");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PartType $partType
     * @return RedirectResponse
     */
    public function destroy(PartType $partType): RedirectResponse
    {
        if ($partType->delete()) {
            return redirect()->back()->with('success', "запись $partType->title удалена");
        }
        return redirect()->back()->with('fail', "Ошибка при удалении");
    }
}
