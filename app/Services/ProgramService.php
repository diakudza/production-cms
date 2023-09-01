<?php

namespace App\Services;


use App\Models\Program;
use App\Actions\ImageAction;
use Illuminate\Support\Facades\Storage;

final class ProgramService
{
    private ImageAction $imageAction;

    public function __construct(ImageAction $imageAction)
    {
        $this->imageAction = $imageAction;
    }

    public function makeProgramFile(Program $program, int $n): string
    {
        Storage::deleteDirectory('/programs/' . $program->machine_id);
        $filename = 'title_' . $n;
        $filename = $program->$filename;
        $content = 'text_' . $n;
        $content = $program->$content;
        Storage::makeDirectory('/programs/' . $program->machine_id);
        Storage::disk('local')->put('/programs/' . $program->machine_id . '/' . $filename, $content);

        return $filename;
    }

    public function store(Program $program, array $validated): bool
    {
        $imageAction = $this->imageAction;

        if (isset($validated['partPhoto'])) {
            $validated['partPhoto'] = $imageAction($validated['partPhoto'], 'programs');
        }

        $program->fill($validated);

        return $program->save();
    }

    public function update(Program $program, array $validated): bool
    {
        $imageAction = $this->imageAction;
        if (isset($validated['partPhoto'])) {
            $validated['partPhoto'] = $imageAction($validated['partPhoto'], 'programs');
        }

        $program->update($validated);

        return $program->save();
    }
}
