<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
