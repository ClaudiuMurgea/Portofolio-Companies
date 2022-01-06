<?php

namespace App\Http\Livewire\Facility\Settings\Banners;

use Livewire\Component;
use App\Models\Banner;

class BannersIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;

    public $facilityID;
    public $bannerID;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }
    
    public function edit ($banner)
    {
        $this->bannerID = $banner;
        $this->show('showEdit', $this->bannerID);
    }

    public function mount ($facility)
    {
        $this->facilityID = $facility;
    }
    
    public function render()
    {
        $banners = Banner::where('facility_id', $this->facilityID)->get();
        return view('livewire.facility.settings.banners.banners-index', ['banners' => $banners])->layout('layouts.admin.master');
    }

}
