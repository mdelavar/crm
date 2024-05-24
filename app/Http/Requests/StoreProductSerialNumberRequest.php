<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductSerialNumberRequest extends FormRequest
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
            'serial' => ['required','integer', Rule::unique('product_serial_numbers')->ignore($this->id)],
            'product_id' => 'required',
            'ma_date' => 'required|date',
            'ex_date' => 'required|date|after:ma_date',
            'description' => 'nullable'
        ];
    }
}
