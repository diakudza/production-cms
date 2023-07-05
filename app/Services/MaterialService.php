<?php

namespace App\Services;

use App\Models\User;
use App\Models\Material;
use App\Actions\ImageAction;

final class MaterialService
{
    private ImageAction $imageAction;

    public function __construct(ImageAction $imageAction)
    {
        $this->imageAction = $imageAction;
    }

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
