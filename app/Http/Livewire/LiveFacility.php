<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\User;
use App\Models\State;
use App\Models\Media;
use App\Models\Company;
use App\Models\Region;

class LiveFacility extends Component
{   
    use WithFileUploads;

    protected $rules = [
        'edit_state' => '',
    ];

    public $selectData  =true;
    public $createData  =false;
    public $updateData  =false;
    public $settingData =false;

    public Company  $company;
    public Facility $facility;
    public $ids;

    public $name;
    public $company_id;
    public $address; 
    public $city;
    public $zip;
    public $state;
    public $phone;
    public $color;
    public $logo;
    public $region;

    public $edit_name;
    public $edit_company_id;
    public $edit_address; 
    public $edit_city;
    public $edit_zip;
    public $edit_state;
    public $edit_phone;
    public $edit_color;
    public $edit_logo;
    public $edit_region;


    public function render()
    {   
        $states = State::all();
        $regions = Region::all();
        $facilities = Facility::where('company_id', $this->company->id)->get();

        return view('livewire.live-facility', ['facilities' => $facilities, 'states' => $states, 'regions' => $regions])->layout('layouts.admin.master');
    }


    public function showForm()
    {   
        $this->createData=true;
        $this->selectData=false; 
    }

    public function resetFields()
    {
        $this->name     ="";
        $this->address  ="";
        $this->city     ="";
        $this->zip      =""; 
        $this->state    ="";
        $this->phone    ="";
        $this->color    ="";
        $this->logo     ="";
        $this->region   ="";
    }

    public function create()
    {   
        $validatedData = $this->validate([
            'name'          => 'required|unique:facilities,name|max:100',
            'address'       => 'required|max:100',
            'city'          => 'required|max:100',
            'zip'           => 'required|numeric',
            'state'         => 'required',
            'phone'         => 'required|numeric',
            'color'         => 'required|max:20',
            'logo'          => 'required|mimes:jpg,jpeg,png|max:20480',
            'region'        => 'required',
        ]);

        $facility = new Facility();
            $facility->name = $validatedData['name'];
            $facility->company_id = $this->company->id;
            $facility->region_id = $validatedData['region'];
            $facility->save();

        $media = new Media();
            $filename = $this->logo->store('photoss');
            $media->url = $filename;
            $media->save();

        $facilityProfile = new FacilityProfile();
            $facilityProfile->facility_id = $facility->id;
            $facilityProfile->address     = $validatedData['address'];
            $facilityProfile->city        = $validatedData['city'];
            $facilityProfile->zip         = $validatedData['zip'];
            $facilityProfile->state_id    = $validatedData['state'];
            $facilityProfile->region_id   = $validatedData['region'];
            $facilityProfile->phone       = $validatedData['phone'];
            $facilityProfile->color       = $validatedData['color'];
            $facilityProfile->logo        = $media->id;
            $facilityProfile->save();

        $this->selectData=true;
        $this->createData=false;
        $this->resetFields();
    }


    public function edit($id)
    {   
        $this->selectData  = false;
        $this->createData  = false;
        $this->settingData = false;
        $this->updateData  = true;
        
        
        $facility = Facility::findOrFail($id);
            $this->edit_name = $facility->name;
            $this->ids = $facility->id;

        $facilityProfile = FacilityProfile::findOrFail($id);
            $this->edit_address = $facilityProfile->address;
            $this->edit_city    = $facilityProfile->city;
            $this->edit_zip     = $facilityProfile->zip;
            $this->edit_state   = $facilityProfile->state;
            $this->edit_phone   = $facilityProfile->phone;
            $this->edit_color   = $facilityProfile->color;
            $this->edit_region  = $facilityProfile->region;

        $media = Media::findOrFail($id);
            $this->edit_logo = $media->url;
    }

    
    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name'          => 'required|unique:facilities,name|max:100',
            'edit_address'       => 'required|max:100',
            'edit_city'          => 'required|max:100',
            'edit_zip'           => 'required|numeric',
            'edit_state'         => 'required',
            'edit_phone'         => 'required|numeric',
            'edit_color'         => 'required|max:20',
            'edit_logo'          => 'required|mimes:jpg,jpeg,png|max:20480',
            'edit_region'        => 'required',
        ]);
        
        $facility = Facility::findOrFail($id);
            $facility->name = $validatedData['edit_name'];
            $facility->save();

        $media = Media::findOrFail($id);
            $filename = $this->edit_logo->store('photoss');
            $media->url = $filename;
            $media->save();

        $facilityProfile = FacilityProfile::findOrFail($id);
            $facilityProfile->address    = $validatedData['edit_address'];
            $facilityProfile->city       = $validatedData['edit_city'];
            $facilityProfile->zip        = $validatedData['edit_zip'];
            $facilityProfile->state_id   = $validatedData['edit_state'];
            $facilityProfile->phone      = $validatedData['edit_phone'];
            $facilityProfile->color      = $validatedData['edit_color'];
            $facilityProfile->logo       = $media->id;
            $facilityProfile->save();

        $this->selectData = true;
        $this->updateData = false;
    }

    
    public function destroy($id)
    {
        $facilityProfile = FacilityProfile::findOrFail($id);
        
            if ($facilityProfile->Media)
            {
                $facilityProfile->Media->delete();
            }

            $facilityProfile->delete();
        
        $facility = Facility::findOrFail($id);
            $facility->delete();
    }

    public function showSetting (Facility $facility)
    {
        $this->selectData  = false;
        $this->createData  = false;
        $this->updateData  = false;
        $this->settingData = true;
        $this->facility = $facility;
    }
}
