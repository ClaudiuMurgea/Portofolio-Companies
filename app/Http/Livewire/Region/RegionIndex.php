<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionIndex extends Component
{   
    public $regions;

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

    public function mount ()
    {
        $this->regions = Region::all();
    }

    public function render()
    {
        return view('livewire.region.region-index')->layout('layouts.admin.master');
    }

    public function destroy($id)
    {   
        $regionProfile = RegionProfile::findOrFail($id);
            $regionProfile->delete();
            
        $region = Region::findOrFail($id);
            $region->delete();

        return redirect('/regions');
    }
}
