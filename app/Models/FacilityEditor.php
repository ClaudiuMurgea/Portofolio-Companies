<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityEditor extends Model
{
    public function Facility ()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
