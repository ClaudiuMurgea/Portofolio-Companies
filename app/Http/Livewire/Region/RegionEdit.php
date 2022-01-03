<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionEdit extends Component
{
    public $ids;
    public $edit_name;
    public $edit_description;

    public $return = false;
    public $active = true;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount ($regionID)
    {
        $region = Region::with(['Details'])->findOrFail($regionID);
            $this->ids              = $region->id;
            $this->edit_name        = $region->name;  
            $this->edit_description = $region->Details->description;
    }

    public function render()
    {
        return view('livewire.region.region-edit')->layout('layouts.admin.master');
    }

    public function update($id)
    {
        $this->validate([
            'edit_name' => 'required|unique:permissions,name,' . $id,
            'edit_description' => 'required|max:255'
        ]);

        $region = Region::findOrFail($id);
            $region->name = $this->edit_name;
            $region->save();

        $regionProfile = RegionProfile::findOrFail($id);
            $regionProfile->description = $this->edit_description;
            $regionProfile->save();
        
        $this->back();
    }   
}
