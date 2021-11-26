<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function Profile ()
    {
        return $this->hasOne(CompanyProfile::class, 'company_id', 'id');
    }

    public function CompanyAdmin ()
    {
        return $this->hasOne(CompanyAdmin::class, 'company_id', 'id');
    }
}
