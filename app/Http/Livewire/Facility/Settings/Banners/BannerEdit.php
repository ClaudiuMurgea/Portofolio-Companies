<?php

namespace App\Http\Livewire\Facility\Settings\Banners;

use Livewire\Component;
use App\Models\Banner;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;
   

class BannerEdit extends Component
{
    use WithFileUploads;
    
    public $banner;
    public $bannerID;
    public $facilityID;
    public $start_at;
    public $end_at;
    public $hour;
    public $minute;
    public $meridiem;
    public $expireDate;

    public $return = false;
    public $active = true;
 
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($banner)
    {
        $this->bannerID = $banner;
        $this->banner   = Banner::find($this->bannerID);
        $this->facilityID = $this->banner->facility_id;
        $this->title    = $this->banner->name; 
        $this->start_at = $this->banner->start_at;
    }

    public function render()
    {
        return view('livewire.facility.settings.banners.banner-edit')->layout('layouts.admin.master');
    }
}
