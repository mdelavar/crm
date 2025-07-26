<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Box extends Model
{
    use HasFactory;

    protected $fillable = ['barcode',
        'representation_id'];

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

    public function representation(): BelongsTo
    {
        return $this->belongsTo(Representation::class , 'representation_id');
    }
}
