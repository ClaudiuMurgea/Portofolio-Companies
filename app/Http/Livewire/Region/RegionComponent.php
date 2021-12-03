<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionComponent extends Component
{
    protected $listeners = ['show'];

    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;

    public function show ($type, $ids = null)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;
        
        $this->$type      = true;
        $this->ids        = $ids;
    }
    
    public function render()
    {
        return view('livewire.region.region-component')->layout('layouts.admin.master');
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
