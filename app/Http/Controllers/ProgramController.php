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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function create(): Factory|View|Application
    {
        return view('public.programAdd', [
            'machines' => Machine::all(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    public function store(ProgramStoreRequest $request, Program $program, ImageAction $imageAction): RedirectResponse
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

        session()->put('viewed.'.$program->id , $program->partNumber);

        return view('public.programSingle', [
            'program' => $program,
            'machines' => Machine::all(),
            'authors' => (new User)->getAdjusterOnly(),
            'partTypes' => PartType::all(),
            'materials' => Material::all(),
        ]);
    }

    public function update(ProgramUpdateRequest $request, ImageAction $imageAction, Program $program): RedirectResponse
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

    public function getProgram(Program $program, int $n): StreamedResponse
    {
        Storage::deleteDirectory('/programs/' . $program->machine_id);
        $filename = 'title_' . $n;
        $filename = $program->$filename;
        $content = 'text_' . $n;
        $content = $program->$content;
        Storage::makeDirectory('/programs/' . $program->machine_id);
        Storage::disk('local')->put('/programs/' . $program->machine_id . '/' . $filename, $content);
        return Storage::download('/programs/' . $program->machine_id . '/' . $filename);
    }

}
