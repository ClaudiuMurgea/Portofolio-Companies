<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function Media ()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
