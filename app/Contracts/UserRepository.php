<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserRepository extends BaseRepository
{
    public function all(): Collection|array;
}
