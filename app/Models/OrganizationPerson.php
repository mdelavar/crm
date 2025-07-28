<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'national_code',
        'phone',
        'car_number',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }


    public function credits() : HasMany
    {
        return $this->hasMany(Credit::class , 'organization_people_id');
    }

    public function remindCredit()
    {
        $activeCredits = Credit::query()->where('organization_people_id', $this->id)->where('end_date' , '>=' , Carbon::now())->where('start_date' , '<=' , Carbon::now())->get();

        $totalCredits = 0;
        $totalUsed = 0;
        foreach ($activeCredits as $credit) {
            $totalCredits += $credit->amount;
            $totalUsed += PersonUseCredit::query()->where('organization_people_id', $this->id)->whereBetween('created_at' , [$credit->start_date,$credit->end_date])->sum('amount');
        }

        return $totalCredits - $totalUsed;

    }
}
