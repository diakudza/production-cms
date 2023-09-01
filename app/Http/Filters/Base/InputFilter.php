<?php

namespace App\Http\Filters\Base;

abstract class InputFilter extends Filter
{
    public string $template = 'input';

    public function render(): string
    {
        return view('components.filters.' . $this->template, [
            'name' => $this->name,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
        ])->render();
    }
}