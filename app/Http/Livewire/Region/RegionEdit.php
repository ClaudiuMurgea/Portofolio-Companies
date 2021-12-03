<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionEdit extends Component
{
    protected $rules = [
        'edit_name'        => 'required|unique:permissions,name',
        'edit_description' => 'required'
    ];

    public $ids;
    public $edit_name;
    public $edit_description;

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
        $validatedData = $this->validate();

        $region = Region::findOrFail($id);
            $region->name = $validatedData['edit_name'];
            $region->save();

        $regionProfile = RegionProfile::findOrFail($id);
            $regionProfile->description = $validatedData['edit_description'];
            $regionProfile->save();
        
        return redirect('/regions');
    }
    
}
