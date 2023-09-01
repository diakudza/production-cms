<?php

namespace App\Http\Filters\Base;

abstract class CheckBoxFilter extends Filter
{
    public string $template = 'checkbox';

    public function render(): string
    {
        return view('components.filters.' . $this->template, [
            'name' => $this->name,
            'placeholder' => $this->placeholder,
        ])->render();
    }
}