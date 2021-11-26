<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function Facility ()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    public function MealType ()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id', 'id');
    }

    public function DayMenu ()
    {
        return $this->belongsTo(DailyMenu::class, 'day_menu_id', 'id');
    }

    public static function getTypeId($type) {
        $types['Breakfast']        = 1;
        $types['Lunch']            = 2;
        $types['Dinner']           = 3;
        $types['Always Available'] = 4;

        return $types[$type];
    }
}
