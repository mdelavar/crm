<?php

namespace App\Imports;

use App\Models\OrganizationPerson;
use App\Rules\NationalCode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrganizationPersonImport implements ToCollection, WithStartRow, WithValidation
{
    protected $organization;
    public function __construct($o)
    {
        $this->organization = $o;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            OrganizationPerson::query()->create([
                'organization_id' => $this->organization,
                'name' =>  $row[0],
                'national_code' =>  $row[1],
                'phone' =>  $row[2],
                'car_number' =>  $row[3],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
            '1' => ['required' , new NationalCode(), 'string' , 'unique:organization_people,national_code'],
            '2' => 'required|string|regex:/^09\d{9}$/',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '0.required' => 'نام الزامی است.',
            '0.string' => 'نام باید حروف باشد.',
            '1.required' => 'کدملی الزامی است.',
            '1.unique'   => 'کدملی تکراری است.',
            '2.required'   => 'شماره همراه الزامی است.',
            '2.regex'   => 'فرمت شماره همراه صحیح نیست',
        ];
    }

}
