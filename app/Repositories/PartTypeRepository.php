<?php

namespace App\Repositories;

use App\Models\PartType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class PartTypeRepository
{
    public function getAllPartType(): Collection|array
    {
        return Cache::remember('all_part_type', 1800, function () {
            return PartType::query()
                ->select('id', 'title')
                ->OrderBy('title')
                ->get();
        });
    }
}
