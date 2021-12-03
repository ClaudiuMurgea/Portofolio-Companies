<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Media;
use App\Models\State;
use App\Models\Region;
use Illuminate\Support\Facades\File;

class FacilityEdit extends Component
{   
    use WithFileUploads;

    // protected $rules = [
    //     'edit_name'    => 'required|unique:facilities,name|max:100',
    //     'edit_address' => 'required|max:100',
    //     'edit_city'    => 'required|max:100',
    //     'edit_zip'     => 'required|numeric',
    //     'edit_state'   => 'required',
    //     'edit_phone'   => 'required|numeric',
    //     'edit_color'   => 'required|max:20',
    //     'edit_logo'    => 'required|mimes:jpg,jpeg,png|max:20480',
    //     'edit_region'  => 'required',   
    // ];
    
    public $ids;
    public $facility;
    public $companyID;
    public $old_logo;
    public $edit_logo;

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
        $validatedData = $this->validate([
            'edit_name'    => 'required|unique:facilities,name|max:100,' .$facilityID,
            'edit_address' => 'required|max:100',
            'edit_city'    => 'required|max:100',
            'edit_zip'     => 'required|numeric',
            'edit_state'   => 'required',
            'edit_phone'   => 'required|numeric',
            'edit_color'   => 'required|max:20',
            'edit_logo'    => 'required|mimes:jpg,jpeg,png|max:20480',
            'edit_region'  => 'required',   
        ]);     
        
        $facility = Facility::findOrFail($facilityID);
            $facility->name = $validatedData['edit_name'];
            $facility->save();

        $media = Media::findOrFail($facilityID);
            $filename = $this->edit_logo->store('photos', 'public');
            $media->url = $filename;
            $media->save();
            $this->edit_logo = $filename;

            if(File::exists("storage/$this->old_logo"))
            {
                File::delete("storage/$this->old_logo");
            }
            else 
            {
                dd('File does not exists.');
            }

        $facilityProfile = FacilityProfile::findOrFail($facilityID);
            $facilityProfile->address    = $validatedData['edit_address'];
            $facilityProfile->city       = $validatedData['edit_city'];
            $facilityProfile->zip        = $validatedData['edit_zip'];
            $facilityProfile->state_id   = $validatedData['edit_state'];
            $facilityProfile->region_id  = $validatedData['edit_region'];
            $facilityProfile->phone      = $validatedData['edit_phone'];
            $facilityProfile->color      = $validatedData['edit_color'];

            $facilityProfile->logo       = $media->id;
            $facilityProfile->save();

        return redirect()->to('/facilities/' . $this->companyID);
    }

}
