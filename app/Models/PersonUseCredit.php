<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonUseCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_people_id',
        'amount',
        'car_service_id',
        'service_id'
    ];

    public function organization_people(): BelongsTo
    {
        return $this->belongsTo(OrganizationPerson::class);
    }

    public function car_service(): BelongsTo
    {
        return $this->belongsTo(CarService::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class);
    }
}
