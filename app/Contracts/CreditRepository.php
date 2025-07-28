<?php

namespace App\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CreditRepository extends BaseRepository
{
    public function organizationCredits($organization_id) : LengthAwarePaginator;
}
