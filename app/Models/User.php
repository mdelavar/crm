<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_users', 'user', 'permission')
            ->withTimestamps();
    }

    public function histories(): BelongsToMany
    {
        return $this->belongsTo(PersonHistory::class, 'person_id', 'change_by')
            ->withTimestamps();
    }

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

    protected function permissionArray(): Attribute
    {
        $perms = [];
        foreach ($this->permissions as $p) {
            $perms[] = $p->key;
        }
        return Attribute::make(
            get: fn() => $perms,
        );
    }

    public function hasPermission($key)
    {
        $permission = Permission::query()->where("key", $key)->first();
        if ($permission) {
            return PermissionUser::query()->where('user', $this->id)->where("permission", $permission->id)->count() > 0;
        }
        return false;
    }
}
