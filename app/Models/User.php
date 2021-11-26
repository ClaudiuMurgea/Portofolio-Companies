<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Company()
    {
        return $this->hasOne(Company::class, 'admin_id', 'id');
    }
    public function FacilityAdmin()
    {
        return $this->hasMany(Facility::class, 'admin_id', 'id');
    }
    public function FacilityEditor()
    {
        return $this->hasOne(Facility::class, 'editor_id', 'id');
    }

    public function userActive ()
    {
        return $this->active == 0;
    }

    public function CompanyOwned ()
    {
        return $this->hasOne(CompanyAdmin::class, 'user_id', 'id');
    }

    public function Region ()
    {
        return $this->hasOne(Region::class, 'id', 'id');
    }
}
