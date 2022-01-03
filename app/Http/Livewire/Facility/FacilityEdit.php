<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Media;
use App\Models\State;
use App\Models\Region;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class FacilityEdit extends Component
{   
    use WithFileUploads;
    
    public $ids;
    public $facility;
    public $companyID;
    public $old_logo;
    public $edit_logo;

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($facilityID)
    {    
        $this->states  = State::all();
        $this->regions = Region::all();

        $facility = Facility::with(['Profile'])->findOrFail($facilityID);
            $this->edit_name    = $facility->name;
            $this->edit_address = $facility->Profile->address;
            $this->edit_city    = $facility->Profile->city;
            $this->edit_zip     = $facility->Profile->zip;
            $this->edit_state   = $facility->Profile->state_id;
            $this->edit_phone   = $facility->Profile->phone;
            $this->edit_color   = $facility->Profile->color;
            $this->edit_region  = $facility->Profile->region_id;
            $this->old_logo     = $facility->Profile->media->url;

            $this->ids = $facilityID;
            $this->facility  = $facility;    
            $this->companyID = $facility->company_id; 
    }

    public function render()
    {   
        return view('livewire.facility.facility-edit')->layout('layouts.admin.master');
    }
    
    public function update($facilityID)
    {
        $this->validate([
            'edit_name'    => 'required|unique:facilities,name,' .$facilityID,
            'edit_address' => 'required|max:100',
            'edit_city'    => 'required|max:100',
            'edit_zip'     => 'required|numeric',
            'edit_state'   => 'required',
            'edit_phone'   => 'required|numeric',
            'edit_color'   => 'required|max:20',
            'edit_logo'    => 'required|mimes:jpg,jpeg,png|max:40960',
            'edit_region'  => 'required',   
        ]);     
        
        $facility = Facility::findOrFail($facilityID);
            $facility->name = $this->edit_name;
            $facility->save();

        $media = Media::findOrFail($facilityID);
            $filename = $this->edit_logo->store('photos', 'public');
            $media->url = $filename;
            $media->save();
            $this->edit_logo = $filename;
                $manager = new ImageManager();
                $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
                $image->save('storage/'.$filename);

            if( File::exists("storage/$this->old_logo") )
            {
                File::delete("storage/$this->old_logo");
            }

        $facilityProfile = FacilityProfile::findOrFail($facilityID);
            $facilityProfile->address    = $this->edit_address;
            $facilityProfile->city       = $this->edit_city;
            $facilityProfile->zip        = $this->edit_zip;
            $facilityProfile->state_id   = $this->edit_state;
            $facilityProfile->region_id  = $this->edit_region;
            $facilityProfile->phone      = $this->edit_phone;
            $facilityProfile->color      = $this->edit_color;
            $facilityProfile->logo       = $media->id;
            $facilityProfile->save();

        $this->back();
    }
}
