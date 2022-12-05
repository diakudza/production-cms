<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MachineUpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'id' => ['required', 'numeric'],
            'ip' => ['required', 'string'],
            'repair' => ['nullable', 'numeric'],
            'created_at' => ['nullable', 'date'],
            'machinePhoto' => ['nullable', 'image'],
            'comment' => ['nullable', 'string'],
            'machinePhotoDelete' => ['nullable', 'numeric']
        ];
    }
}
