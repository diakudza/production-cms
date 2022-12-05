<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'tabNumber' => ['nullable', 'numeric', 'min:4'],
            'name' => ['nullable', 'string', 'min:5'],
            'position_id' => ['nullable', 'numeric', 'exists:positions,id'],
            'shift_id' => ['nullable', 'numeric', 'in:0,1,2'],
            'employmentDate' => ['nullable', 'date'],
            'status' => ['nullable', 'in:WORKS,FIRED'],
            'role' => ['nullable', 'in:ADMIN,SUSER'],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image'],
            'avatarDelete' => ['nullable'],

        ];
    }
}
