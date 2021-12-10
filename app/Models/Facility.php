<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;


class Facility extends Model
{
    protected $fillable = ['company_id', 'name', 'region_id' ];

    public function Profile ()
    {
        return $this->hasOne(FacilityProfile::class, 'facility_id', 'id');
    }

    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function Permissions ()
    {
        return $this->belongsTo(Permission::class, 'region_id', 'id');
    }

    // public function Media ()
    // {
    //     return $this->hasOneThrough(
    //         Media::class,
    //         FacilityProfile::class,
    //         'facility_id',
    //         'id',
    //         'id',
    //         'logo'
    //     );
    // }

    public function Menus ($date)
    {
        return $this->hasManyThrough(
            MenuItem::class,
            DailyMenu::class,
            'facility_id',
            'day_menu_id',
            'id',
            'id'
        )->where('day_menu',$date)->get();
    }

    public function Settings () 
    {
        return $this->hasOne(FacilitySettings::class, 'facility_id', 'id');
    }

    public function DailyMenus()
    {
        return $this->hasMany(DailyMenu::class, 'facility_id', 'id');
    }

    public function Displays()
    {
        return $this->hasMany(Display::class, 'facility_id', 'id');
    }

    public function Banners()
    {
        return $this->hasMany(Banner::class, 'facility_id', 'id');
    }

    public function FacilityAdmins ()
    {
        return $this->hasMany(FacilityAdmin::class, 'facility_id', 'id');
    }

    public function FacilityEditors ()
    {
        return $this->hasMany(FacilityEditor::class, 'facility_id', 'id');
    }

    public function FacilityUsers ()
    {
        return $this->hasMany(FacilityUser::class, 'facility_id', 'id');
    }


    public function Users ()
    {
        return $this->hasManyThrough( User::class, FacilityAdmin::class,
                                     'facility_id', 'id',
                                     'id', 'user_id'                    );
    }

}
