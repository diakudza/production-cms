<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'tabNumber' => ['required', 'numeric', 'min:4'],
            'password' => ['required', 'min:4', 'confirmed'],
            'name' => ['required', 'string', 'min:5'],
            'position_id' => ['required', 'numeric', 'exists:positions,id'],
            'shift_id' => ['required', 'numeric', 'in:0,1,2'],
            'employmentDate' => ['required', 'date'],
            'status' => ['required', 'in:WORKS,FIRED'],
            'role' => ['nullable', 'in:ADMIN,USER'],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image'],
        ];
    }
}
