<?php

namespace App\Services;


use App\Actions\ImageAction;
use App\Models\Machine;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

final class MachineService
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

    public function store(Machine $machine, array $validated): bool
    {
        $machine->fill($validated);
        return $machine->save();
    }

    public function update(Machine $machine, array $validated): bool
    {
        $imageAction = $this->imageAction;
        $validated['repair'] = $validated['repair'] ?? 0;
        if (isset($validated['machinePhoto'])) {
            $validated['machinePhoto'] = $imageAction($validated['machinePhoto'], 'machines', 400, 400);
        }
        if (isset($validated['machinePhotoDelete'])) {
            $validated['machinePhoto'] = null;
        }
        $machine->update($validated);

        return $machine->save();
    }
}
