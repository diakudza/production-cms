<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProgramRequest extends FormRequest
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
            'partType' => 'nullable|numeric|exists:partTypes,id',
            'partNumber' => 'nullable|string',
            'machine_id' => 'nullable|numeric|exists:machines,id',
            'author' => 'nullable|numeric|exists:users,id',
            'sortBy' => 'nullable|string',
            'itemOnPage' => 'nullable|numeric',
        ];
    }
}
