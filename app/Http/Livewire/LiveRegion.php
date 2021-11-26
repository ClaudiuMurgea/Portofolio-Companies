<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Region;
use App\Models\RegionProfile;

class LiveRegion extends Component
{   

    public $selectData=true;
    public $createData=false;
    public $updateData=false;

    public $ids;

    public $name;
    public $description;

    public $edit_name;
    public $edit_description;

    public function showForm()
    {   

        $this->createData=true;
        $this->selectData=false;
        
    }


    public function render()
    {
        $regions = Region::all();
        $regionProfiles = RegionProfile::all();
        return view('livewire.live-region', ['regions' => $regions, 'regionProfiles' => $regionProfiles])->layout('layouts.admin.master');
    }


    public function resetFields()
    {
        $this->name = "";
        $this->description = "";
    }


    public function create()
    {
        $validatedData = $this->validate([
            'name'        => 'required|unique:permissions,name',
            'description' => 'required'
        ]);
        
        $region = new Region();
        $region->guard_name = "web";
        $region->name = $validatedData['name'];
        $region->save();

        $regionProfile = new RegionProfile();
        $regionProfile->region_id = $region->id;
        $regionProfile->description = $validatedData['description'];
        $regionProfile->save();

        $this->selectData = true;
        $this->createData = false;
        $this->resetFields();
    }


    public function edit ($id)
    {
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

        $region = Region::findOrFail($id);
        $this->edit_name = $region->name;
        $this->ids       = $region->id;

        $regionProfile = RegionProfile::findOrFail($id);
        $this->edit_description = $regionProfile->description;
    }


    public function update($id)
    {

        $validatedData = $this->validate([
            'edit_name'        => 'required|unique:permissions,name',
            'edit_description' => 'required'
        ]);

        $region = Region::findOrFail($id);
            $region->name = $validatedData['edit_name'];
            $region->save();

        $regionProfile = RegionProfile::findOrFail($id);
            $regionProfile->description = $validatedData['edit_description'];
            $regionProfile->save();
        
        $this->selectData = true;
        $this->updateData = false;
    }


    public function destroy($id)
    {   
        $regionProfile = RegionProfile::findOrFail($id);
            $regionProfile->delete();
            
        $region = Region::findOrFail($id);
            $region->delete();
    }

}
