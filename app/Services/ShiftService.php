<?php

namespace App\Services;

use App\Models\Shift;

final class ShiftService
{

    public function store(Shift $shift, array $validated): bool
    {
        $shift->fill($validated);

        return $shift->save();
    }

    public function update(Shift $shift, array $validated): bool
    {
        $validated['week'] = $validated['week'] ?? 0;
        $shift->update($validated);

        return $shift->save();
    }
}
