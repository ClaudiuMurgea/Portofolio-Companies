<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\State;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Region;
use Livewire\WithFileUploads;
use App\Models\Media;


class FacilityCreate extends Component
{   
    use WithFileUploads;

    protected $rules = [
        'name'    => 'required|unique:facilities,name|max:100',
        'address' => 'required|max:100',
        'city'    => 'required|max:100',
        'zip'     => 'required|numeric',
        'state'   => 'required',
        'phone'   => 'required|numeric',
        'color'   => 'required|max:20',
        'logo'    => 'required|mimes:jpg,jpeg,png|max:20480',
        'region'  => 'required',
    ];

    public $ids;
    public $states;
    public $regions;

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

    public function render()
    {
        return view('livewire.facility.facility-create')->layout('layouts.admin.master');
    }

    public function mount($companyID)
    {
        $this->ids = $companyID;
        $this->states  = State::all();
        $this->regions = Region::all();
    }

    public function create()
    {   
        $validatedData = $this->validate();

        $facility = new Facility();
            $facility->name = $validatedData['name'];
            $facility->company_id = $this->ids;
            $facility->region_id = $validatedData['region'];
            $facility->save();

        $media = new Media();
            $filename = $this->logo->store('photos', 'public');
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

        return redirect()->to('/facilities/' . $this->ids);
    }

}
