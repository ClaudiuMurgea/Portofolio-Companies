<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyMenu extends Model
{
    public function MenuType ()
    {
        return $this->hasOne(MealType::class, 'id', 'menu_type');
    }

    public function MenuItems ()
    {
        return $this->hasMany(MenuItem::class, 'day_menu_id', 'id');
    }

    public function Facility ()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
