<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\Media;
use App\Models\State;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Region;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

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
        'logo'    => 'required|mimes:jpg,jpeg,png|max:40960',
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

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function render()
    {
        return view('livewire.facility.facility-create')->layout('layouts.admin.master');
    }

    public function mount($company)
    {
        $this->ids = $company;
        $this->states  = State::all();
        $this->regions = Region::all();
    }

    public function create()
    {   
        $this->validate();

        $facility = new Facility();
            $facility->name = $this->name;
            $facility->company_id = $this->ids;
            $facility->region_id = $this->region;
            $facility->save();

        $media = new Media();
        $filename = $this->logo->store('photos', 'public');
        $media->url = $filename;
        $media->save();
            $manager = new ImageManager();
            $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
            $image->save('storage/'.$filename);

        $facilityProfile = new FacilityProfile();
            $facilityProfile->facility_id = $facility->id;
            $facilityProfile->address     = $this->address;
            $facilityProfile->city        = $this->city;
            $facilityProfile->zip         = $this->zip;
            $facilityProfile->state_id    = $this->state;
            $facilityProfile->region_id   = $this->region;
            $facilityProfile->phone       = $this->phone;
            $facilityProfile->color       = $this->color;
            $facilityProfile->logo        = $media->id;
            $facilityProfile->save();

        $this->back();
    }
}
