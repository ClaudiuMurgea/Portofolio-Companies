<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Region extends Permission
{
    public function Details ()
    {
        return $this->hasOne(RegionProfile::class, 'region_id', 'id');
    }
}
