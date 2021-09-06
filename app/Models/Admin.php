<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = [];

    protected $hidden = [
        'security',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAdminRoleAttribute()
    {
        foreach ($this->roles as $role) {
            return $role;
        }
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
