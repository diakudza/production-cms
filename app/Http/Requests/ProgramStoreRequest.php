<?php

namespace App\Http\Requests;

use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;

class ProgramStoreRequest extends FormRequest
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
            'partNumber' => ['required'],
            'machine_id' => ['required', 'numeric', 'exists:machines,id'],
            'material_id' => ['required', 'numeric', 'exists:materials,id'],
            'partType_id' => ['required', 'numeric', 'exists:partTypes,id'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'materialType' => ['required', 'in:hexagon,round,tube,square'],
            'programNameForHead1' => ['required', 'alpha_num', 'size:5'],
            'programNameForHead2' => ['required', 'alpha_num', 'size:5'],
            'programTextForHead1' => ['nullable', 'string'],
            'programTextForHead2' => ['nullable', 'string'],
            'partPhoto' => ['nullable', 'image'],
            'description' => ['nullable'],
            'materialDiametr' => ['nullable', 'numeric'],
        ];
    }
}
