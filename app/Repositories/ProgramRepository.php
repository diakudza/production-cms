<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Support\Facades\Cache;
use App\Http\Filters\InputProgramFilter;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Filters\Program\SelectProgramFilter;
use App\Http\Filters\Program\CheckBoxProgramFilter;
use App\Http\Filters\Program\InputProgramNumberFilter;

final class ProgramRepository
{

    public function __construct(
        public MaterialRepository $materialRepository,
        public MachineRepository $machineRepository,
        public PartTypeRepository $partTypeRepository,
        public UserRepository $userRepository,
    ) {
    }

    public function getAllPrograms(): Collection|array
    {
        return Cache::remember('all_programs', 1800, function () {
            return Program::all();
        });
    }

    public function getLastPrograms(int $count): Collection|array
    {
        return Cache::remember('last_programs_' . $count, 1800, function () use ($count) {
            return Program::query()
                ->OrderBy('created_at', 'desc')
                ->with('user')
                ->limit($count)
                ->get();
        });
    }

    public function getProgramsForMachine(int $machineId): Collection|array
    {
        return Program::with(['user', 'machine'])
            ->whereRelation('machine', 'id', '=', $machineId)
            ->get();
    }

    public function getFilteredPrograms(?int $itemOnPage)
    {
        return Program::filter(list: $this->getFiltersForSearch())
            ->with(['user', 'partType', 'material', 'machine'])
            ->paginate($itemOnPage ?? 20)
            ->withQueryString();
    }

    public function getFiltersForSearch(): array
    {
        return [
            new InputProgramNumberFilter(name: 'part-number', placeholder: 'Номер Детали', colName: 'partNumber',value: 'partNumber'),
            new SelectProgramFilter(
                name: 'author',
                list: $this->userRepository->getAdjusterOnly(),
                placeholder: 'Автор',
                colName: 'user_id'
            ),
            new SelectProgramFilter(
                name: 'machine',
                list: $this->machineRepository->getAllMachines(),
                placeholder: 'Станок',
                colName: 'machine_id'
            ),
            new SelectProgramFilter(
                name: 'part-type',
                list: $this->partTypeRepository->getAllPartType(),
                placeholder: 'Тип детали',
                colName: 'partType_id'
            ),
            new SelectProgramFilter(
                name: 'material',
                list: $this->materialRepository->getAllMaterial(),
                placeholder: 'Материал',
                colName: 'material_id'
            ),
            new CheckBoxProgramFilter( name: 'with-photo',
                placeholder: 'Фото',
                colName: 'partPhoto'),
        ];
    }
}
