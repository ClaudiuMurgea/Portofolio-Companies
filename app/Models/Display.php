<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    public function Type ()
    {
        return $this->hasOne(DisplayType::class, 'id', 'display_type');
    }

    public function Facility ()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }

    public function Media ()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }

    public function NetworkDetails ()
    {
        return $this->hasOne(DisplayNetworkSettings::class, 'display_id', 'id');
    }
}
