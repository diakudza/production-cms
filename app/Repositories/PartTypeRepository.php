<?php

namespace App\Repositories;

use App\Models\PartType;
use Illuminate\Database\Eloquent\Collection;

final class PartTypeRepository
{
    public function getAllPartType(): Collection|array
    {
        return PartType::query()
            ->select('id', 'title')
            ->OrderBy('title')
            ->get();
    }
}
