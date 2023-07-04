<?php

namespace App\Services;


use App\Models\Program;
use Illuminate\Support\Facades\Storage;

final class ProgramService
{
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
}
