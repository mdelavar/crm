<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id',
        'by_user',
        'relation_category_id',
        'title',
        'call_time',
        'call_result',
        'next_call_time'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($item) {
            $item->created_by = Auth::id();
            $item->by_user = Auth::id();
        });

        static::updating(function ($item) {
            $item->changed_by = Auth::id();
        });
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(RelationCategory::class, 'relation_category_id');
    }

}
