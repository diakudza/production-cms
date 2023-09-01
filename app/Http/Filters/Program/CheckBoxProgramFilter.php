<?php

namespace App\Http\Filters\Program;

use App\Http\Filters\Base\InputFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\Base\CheckBoxFilter;

class CheckBoxProgramFilter extends CheckBoxFilter
{
    public function query(Builder $builder, string $colName, ?string $var): Builder
    {
        return $builder->when($var, function ($q) use ($var, $colName) {
            $q->whereNotNull($colName);
        });
    }
}