<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function Media ()
    {
        return $his->hasOne(Media::class, 'id', 'media_id');
    }

    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
