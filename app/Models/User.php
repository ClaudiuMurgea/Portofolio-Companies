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

    public function CompanyAdmin ()
    {
        return $this->hasMany(CompanyAdmin::class, 'user_id', 'id');
    }

    public function FacilityAdmins ()
    {
        return $this->hasOne(FacilityAdmin::class, 'user_id', 'id');
    }

    public function FacilityEditors ()
    {
        return $this->hasMany(FacilityEditor::class, 'user_id', 'id');
    }

    public function FacilityUsers ()
    {
        return $this->hasMany(FacilityUser::class, 'user_id', 'id');
    }

    public function userActive ()
    {
        return $this->active == 0;
    }

    // public function CompanyOwned ()
    // {
    //     return $this->hasOne(CompanyAdmin::class, 'user_id', 'id');
    // }

    public function Regions ()
    {
        return $this->hasMany(Region::class, 'id', 'id');
    }

}
