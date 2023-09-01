<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

final class MaterialRepository
{
    public function getAllMaterial(): Collection|array
    {
        return Cache::remember('all_material', 1800, function () {
            return Material::all();
        });
    }
}
