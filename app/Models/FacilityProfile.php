<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityProfile extends Model
{
    use SoftDeletes;
    
    public function Facility ()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    public function State ()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    
    public function Media ()
    {
        return $this->hasOne(Media::class, 'id', 'logo');
    }
}
