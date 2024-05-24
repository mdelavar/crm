<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'en_name' => 'nullable',
            'description' => 'nullable',
            'product_category_id' => 'required|integer',
            'pic' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg'],
        ];
    }
}
