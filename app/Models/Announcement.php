<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function AllowedDisplaysTypes ()
    {
        return $this->hasMany(AnnouncementsDisplay::class, 'announcement_id', 'id');
    }

    public function Company ()
    {
        return $this->belongsTo(Company::class);
    }
}
