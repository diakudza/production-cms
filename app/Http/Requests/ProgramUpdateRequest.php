<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramUpdateRequest extends FormRequest
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
            'partNumber' => ['nullable'],
            'machine_id' => ['nullable', 'numeric', 'exists:machines,id'],
            'material_id' => ['nullable', 'numeric', 'exists:materials,id'],
            'partType_id' => ['nullable', 'numeric', 'exists:partTypes,id'],
            'user_id' => ['nullable', 'numeric', 'exists:users,id'],
            'materialType' => ['nullable', 'in:hexagon,round,tube,square'],
            'title_1' => ['nullable', 'alpha_num', 'size:5'],
            'title_2' => ['nullable', 'alpha_num', 'size:5'],
            'text_1' => ['nullable', 'string'],
            'text_2' => ['nullable', 'string'],
            'partPhoto' => ['nullable', 'image'],
            'description' => ['nullable'],
            'materialDiameter' => ['nullable', 'numeric'],
        ];
    }
}
