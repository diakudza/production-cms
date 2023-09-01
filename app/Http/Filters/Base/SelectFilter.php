<?php

namespace App\Http\Filters\Base;

use Illuminate\Support\Collection;

abstract class SelectFilter extends Filter
{
    public string $template = 'select';

    public Collection $list;

    public function __construct(
        string $name,
        Collection $list,
        ?string $placeholder  = null,
        ?string $value = null,
        ?string $colName = null,
    ) {
        parent::__construct(
            name: $name,
            placeholder: $placeholder,
            value: $value,
            colName: $colName
        );

        $this->list = $list;
    }

    public function render(): string
    {
        return view('components.filters.' . $this->template, [
            'name' => $this->name,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'list' => $this->list,
        ])->render();
    }
}