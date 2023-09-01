<?php

namespace App\Services;

use App\Models\Material;

final class MaterialService
{
    public function store(Material $material, array $validated): bool
    {
        if ($validated['color'] && $validated['colorAdd']) {
            $validated['color'] = $validated['color'] . ',' . $validated['colorAdd'];
        }
        $material->fill($validated);

        return $material->save();
    }

    public function update(Material $material, array $validated): bool
    {
        if ($validated['color'] && $validated['colorAdd']) {
            $validated['color'] = $validated['color'] . ',' . $validated['colorAdd'];
        }
        $material->update($validated);

        return $material->save();
    }
}
