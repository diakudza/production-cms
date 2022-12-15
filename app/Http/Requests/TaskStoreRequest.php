<?php

namespace App\Http\Requests;

use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'machine_id' => ['required', 'exists:machines,id'],
            'count' => ['required', 'numeric'],
            'currentCount' => ['nullable', 'numeric'],
            'date' => ['required', 'date'],
            'inWork' => ['nullable', 'numeric'],
            'completed' => ['nullable', 'numeric'],
            'taskStatus' => ['nullable', 'string']
        ];
    }
}
