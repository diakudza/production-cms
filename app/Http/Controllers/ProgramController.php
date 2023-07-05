<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Machine;
use App\Models\Program;
use App\Models\Material;
use App\Models\PartType;
use App\Services\ProgramService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProgramStoreRequest;
use App\Http\Requests\ProgramUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ProgramController extends Controller
{
    private ProgramService $programService;

    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
        $this->authorizeResource(Program::class, 'program');
    }

    public function create(): Factory|View|Application
    {
        return view('public.programAdd', [
            'machines' => Machine::all(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    public function store(ProgramStoreRequest $request, Program $program): RedirectResponse
    {
        $this->programService->store($program, $request->validated());
        return redirect()->route('program.show', $program->id);
    }

    public function show(Program $program): Factory|View|Application
    {
        session()->put('viewed.' . $program->id, $program->partNumber);

        return view('public.programSingle', [
            'program' => $program,
            'machines' => Machine::all(),
            'authors' => (new User)->getAdjusterOnly(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    public function update(ProgramUpdateRequest $request, Program $program): RedirectResponse
    {
        $this->programService->update($program, $request->validated());
        return redirect()->back()->with('success', 'Программа обновлена!');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if (!$program->delete()) {
            return redirect()->back()->with('fail', 'Ошибка удаления программы!');
        }
        return redirect()->route('home')->with('success', 'Программа успешно удалена');
    }

    public function getProgram(Program $program, int $n): StreamedResponse
    {
        $filename = $this->programService->makeProgramFile($program, $n);

        return Storage::download('/programs/' . $program->machine_id . '/' . $filename);
    }

}
