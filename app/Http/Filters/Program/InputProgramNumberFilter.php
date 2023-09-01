<?php

namespace App\Http\Filters\Program;

use App\Http\Filters\Base\InputFilter;
use Illuminate\Database\Eloquent\Builder;

class InputProgramNumberFilter extends InputFilter
{
    public function query(Builder $builder, string $colName, ?string $var): Builder
    {
        return $builder->when($var, function ($q) use ($var, $colName) {
            $q->where($colName, 'LIKE', "%" . strtolower($var) . "%");
        });
    }
}