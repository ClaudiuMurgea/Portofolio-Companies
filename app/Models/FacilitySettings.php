<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitySettings extends Model
{
    public function Facility ()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    public function Schedule ()
    {
        return $this->hasOne(ScheduleType::class, 'id', 'schedule_type');
    }
}
