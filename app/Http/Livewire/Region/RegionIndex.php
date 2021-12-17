<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionIndex extends Component
{   
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;
        
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function render()
    {
        $regions = Region::all();
        return view('livewire.region.region-index', ['regions' => $regions] )->layout('layouts.admin.master');
    }

    public function destroy($id)
    {   
        $regionProfile = RegionProfile::where('region_id', $id);
            $regionProfile->delete();
            
        $region = Region::findOrFail($id);
            $region->delete();
    }
}
