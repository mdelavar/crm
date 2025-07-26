<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Representation extends Model
{
    use HasFactory;

    protected $fillable = ['name',
        'phone',
        'address'];

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
