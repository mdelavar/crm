<?php

namespace App\Http\Requests;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationPersonRequest extends FormRequest
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
            'organization_id' => 'required|exists:organizations,id',
            'name' => 'required|string',
            'national_code' => ['required' , new NationalCode(), 'string' , 'unique:organization_people,national_code,' . $this->id],
            'phone' => 'required|string|regex:/^09\d{9}$/',
            'car_number' => 'required|string',
        ];
    }
}
