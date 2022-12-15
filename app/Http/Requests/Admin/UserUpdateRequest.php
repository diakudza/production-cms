<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use App\Rules\UserRoleRule;
use App\Rules\UserStatusRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'dateOfDismissal' => ['nullable', 'date'],
            'status' => ['nullable',  new UserStatusRule],
            'role' => ['nullable', new UserRoleRule],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image'],
            'avatarDelete' => ['nullable'],

        ];
    }
}
