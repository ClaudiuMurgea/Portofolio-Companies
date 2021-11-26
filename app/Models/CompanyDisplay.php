<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDisplay extends Model
{
    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function Type ()
    {
        return $this->belongsTo(DisplayType::class, 'display_type', 'id');
    }
}
