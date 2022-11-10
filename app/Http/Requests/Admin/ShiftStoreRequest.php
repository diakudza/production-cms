<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShiftStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => ['required', 'numeric'],
            'start_time' => ['required', 'date_format:H:i:s',],
            'end_time' => ['required', 'date_format:H:i:s'],
            'week' => ['nullable', 'int'],
        ];
    }
}
