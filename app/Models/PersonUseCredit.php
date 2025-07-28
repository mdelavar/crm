<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonUseCredit extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_people_id',
        'amount',
        'car_service_id',
        'service_id'
    ];
}
