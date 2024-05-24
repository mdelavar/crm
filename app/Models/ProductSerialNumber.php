<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ProductSerialNumber extends Model
{
    use HasFactory;

    protected $fillable = ['serial',
        'description',
        'product_id',
        'ma_date',
        'ex_date'];

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
