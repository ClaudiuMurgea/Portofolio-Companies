<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementDisplay extends Model
{
    public function DisplayType ()
    {
        return $this->hasOne(DisplayType::class, 'id', 'display_type_id');
    }
}
