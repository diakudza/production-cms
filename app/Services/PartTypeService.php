<?php

namespace App\Services;

use App\Models\PartType;

final class PartTypeService
{
    public function store(array $data): PartType|false
    {
        $partType = new PartType();
        $partType->fill($data);
        $result = $partType->save();

        return $result ? $partType : false;
    }

    public function update(int $partTypeId, array $data): bool|int
    {
        $partType = PartType::query()
            ->where('id', $partTypeId)->firstOrFail();

        return $partType->update($data);
    }

    public function destroy(int $partTypeId): int
    {
        $partType = PartType::query()
            ->where('id', $partTypeId)->firstOrFail();

        return $partType->destroy($partTypeId);
    }
}
