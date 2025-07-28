<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_people_id',
        'amount',
        'start_date',
        'end_date',
    ];

    public function person()
    {
        return $this->belongsTo(OrganizationPerson::class, 'organization_people_id');
    }
}
