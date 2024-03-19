<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignRanksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rank_ids' => 'required|array',
            'rank_ids.*' => 'exists:ranks,id'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'rank_ids.required' => 'The rank IDs are required.',
            'rank_ids.array' => 'The rank IDs must be an array.',
            'rank_ids.*.exists' => 'One or more of the specified ranks do not exist.',
        ];
    }
}
