<?php

namespace Modul\Permission\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $table ='yonetici';
    protected $guard_name = 'web';
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'name', 'email', 'sifre',
    ];

    protected $hidden = [
        'sifre', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['sifre'] = Hash::make($password);
    }
}
