<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelationRequest extends FormRequest
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
            'id' => 'nullable',
            'contact_id' => 'required',
            'relation_category_id' => 'required',
            'title' => 'required',
            'call_result' => 'required',
            'call_time' => 'required|date',
            'next_call_time' => 'nullable|date|after:call_time',
        ];
    }
}
