<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionCreate extends Component
{
    protected $rules = [
        'name'        => 'required|unique:permissions,name',
        'description' => 'required'
    ];

    public $name;
    public $description;

    public function render()
    {
        return view('livewire.region.region-create')->layout('layouts.admin.master');
    }

    public function create()
    {
        $validatedData = $this->validate();
        
        $region = new Region();
        $region->guard_name = "web";
        $region->name = $validatedData['name'];
        $region->save();

        $regionProfile = new RegionProfile();
        $regionProfile->region_id = $region->id;
        $regionProfile->description = $validatedData['description'];
        $regionProfile->save();
        
        return redirect('/regions');
    }
}
