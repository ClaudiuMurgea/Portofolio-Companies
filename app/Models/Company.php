<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    public function Profile ()
    {
        return $this->hasOne(CompanyProfile::class, 'company_id', 'id');
    }

    public function CompanyAdmins ()
    {
        return $this->hasMany(CompanyAdmin::class, 'company_id', 'id');
    }

    public function Users ()
    {
        return $this->hasManyThrough( User::class, CompanyAdmin::class,
                                     'company_id', 'id',
                                     'id', 'user_id'                    );
    }

    public function Facilities ()
    {
        return $this->hasMany(Facility::class, 'company_id', 'id');
    }

    public function Settings ()
    {
        return $this->hasOne(CompanySettings::class, 'company_id', 'id');
    }
}
