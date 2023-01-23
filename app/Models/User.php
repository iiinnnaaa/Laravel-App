<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * @property string name
 * @property string fullName
 * @property integer code
 */
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
        'role_id',
        'image',
        'code',
        'is_verified'
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
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getFullNameAttribute()
    {
//        return $this->first_name . ' ' . $this->last_name;
    }

    public function setFullNameAttribute($value)
    {
        $this->first_name = $value;
    }

//    protected function fullName(): Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->first_name . ' ' . $this->last_name,
//            set: fn () => $this->first_name . ' ' . $this->last_name,
//        );
//    }
}
