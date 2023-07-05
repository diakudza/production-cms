<?php

namespace App\Repositories;

use App\Actions\ImageAction;
use App\Models\Program;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class ShiftRepository
{
    public function getShifts(): Collection|array
    {
        return Shift::query()->select(['id','number','start_time','end_time','week'])->get();
    }
    public function getShiftsWithUsers(): Collection|array
    {
        return Shift::with('users')->get();
    }
}
