<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Permission extends Model
{
    use HasFactory;

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($item) {
            $item->created_by = Auth::id();
        });

        static::updating(function ($item) {
            $item->changed_by = Auth::id();
        });
    }

}
