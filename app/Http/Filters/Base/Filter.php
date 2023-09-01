<?php

namespace App\Http\Filters\Base;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public string $name;
    public ?string $placeholder;
    public ?string $value;
    public ?string $colName;

    public function __construct(
        string $name,
        ?string $placeholder = null,
        ?string $value = null,
        ?string $colName = null
    ) {
        $this->name = $name;
        $this->colName = $colName ?? $name;
        $this->placeholder = $placeholder ?? null;
        $this->value = $value ?? $name;
    }

    public function query(Builder $builder, string $colName, ?string $var): Builder
    {
        return $builder->when($var, function ($q) use ($var, $colName) {
            $q->where($colName, strtolower($var));
        });
    }
}