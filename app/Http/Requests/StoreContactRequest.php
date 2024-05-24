<?php

namespace App\Http\Requests;

use App\Rules\Mobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|string',
            'mobile' => ['required', new Mobile()],
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'email' => 'nullable|email',
            'social' => 'nullable|string',
            'postal_code' => 'nullable|string|min:16|max:16',
            'status' => 'nullable',
        ];
    }
}
