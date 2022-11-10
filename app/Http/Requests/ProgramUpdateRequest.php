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
            'programNameForHead1' => ['nullable', 'alpha_num', 'size:5'],
            'programNameForHead2' => ['nullable', 'alpha_num', 'size:5'],
            'programTextForHead1' => ['nullable', 'string'],
            'programTextForHead2' => ['nullable', 'string'],
            'partPhoto' => ['nullable', 'image'],
            'description' => ['nullable'],
            'materialDiametr' => ['nullable', 'numeric'],
        ];
    }
}
