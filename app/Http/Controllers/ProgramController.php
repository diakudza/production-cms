<?php

namespace App\Http\Controllers;

use App\Actions\ImageAction;
use App\Http\Requests\ProgramStoreRequest;
use App\Http\Requests\ProgramUpdateRequest;
use App\Models\Machine;
use App\Models\Material;
use App\Models\PartType;
use App\Models\Program;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    /**
     * Создать экземпляр контроллера.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Program::class, 'program');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('public.programAdd', [
            'machines' => Machine::all(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    public function store(ProgramStoreRequest $request, Program $program, ImageAction $imageAction)
    {
        $validated = $request->validated();

        if (isset($validated['partPhoto'])) {
            $validated['partPhoto'] = $imageAction($validated['partPhoto'], 'programs');
        }

        $program->fill($validated)->save();

        return redirect()->route('program.show', $program->id);
    }


    public function show(Program $program): Factory|View|Application
    {
        return view('public.programSingle', [
            'program' => $program,
            'machines' => Machine::all(),
            'authors' => (new User)->getAdjusterOnly(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Program $program
     * @return Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Program $program
     * @return Response
     */
    public function update(ProgramUpdateRequest $request, ImageAction $imageAction, Program $program)
    {
        $validated = $request->validated();

        if (isset($validated['partPhoto'])) {
            $validated['partPhoto'] = $imageAction($validated['partPhoto'], 'programs');
        }

        $program->update($validated);
        $program->save();
        return redirect()->back()->with('success', 'Программа обновлена!');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if (!$program->delete()) {
            return redirect()->back()->with('fail', 'Ошибка удаления программы!');
            }
        return redirect()->route('home')->with('success', 'Программа успешно удалена');
    }
}
