<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use App\Rules\UserRoleRule;
use App\Rules\UserStatusRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'status' => ['required', new UserStatusRule],
            'role' => ['required', new UserRoleRule],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image'],
        ];
    }
}
