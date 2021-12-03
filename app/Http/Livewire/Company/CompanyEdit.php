<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\State;
use App\Models\Media;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyAdmin;
use App\Models\Facility;
use App\Models\FacilityProfile;
use Illuminate\Support\Facades\File;

class CompanyEdit extends Component
{   
    use WithFileUploads;

    protected $listeners = ['update'];

    // protected $rules = [
    //     'edit_name'    => 'required|unique:companies,name|max:100,'. $ids,
    //     'edit_address' => 'required|max:100',
    //     'edit_city'    => 'required|max:100',
    //     'edit_zip'     => 'required|numeric',
    //     'edit_state'   => 'required',
    //     'edit_logo'    => 'nullable|mimes:jpg,jpeg,png|max:20480',
    //     'edit_phone'   => 'required|numeric',
    //     'edit_color'   => 'required|max:20'     
    // ];

    public $ids;
    public $company;
    public $states;
    public $edit_name;
    public $edit_address; 
    public $edit_city;
    public $edit_zip;
    public $edit_state;
    public $edit_phone;
    public $edit_color;
    public $edit_logo;
    public $old_logo;

    public function mount ($companyID)
    {
        $company = Company::with(['Profile.Media'])->findOrFail($companyID);
            $this->ids          = $company->id;
            $this->edit_name    = $company->name;
            $this->edit_city    = $company->Profile->city;
            $this->edit_zip     = $company->Profile->zip;
            $this->edit_address = $company->Profile->address;
            $this->edit_state   = $company->Profile->state_id;
            $this->edit_phone   = $company->Profile->phone;
            $this->edit_color   = $company->Profile->color;
            $this->old_logo     = $company->Profile->media->url;
        $this->states = State::all();
        $this->company = $company;
    }

    public function render ()
    {   
        return view('livewire.company.company-edit')->layout('layouts.admin.master');
    }

    public function update ($id)
    {   
        $validatedData = $this->validate([
            'edit_name'    => 'required|unique:companies,name|max:100,'. $id,
            'edit_address' => 'required|max:100',
            'edit_city'    => 'required|max:100',
            'edit_zip'     => 'required|numeric',
            'edit_state'   => 'required',
            'edit_logo'    => 'nullable|mimes:jpg,jpeg,png|max:20480',
            'edit_phone'   => 'required|numeric',
            'edit_color'   => 'required|max:20'     
        ]);

        $company = Company::findOrFail($id);
            $company->name = $validatedData['edit_name'];
            $company->save();

        if(!$this->edit_logo == null)
        {
            $media = Media::findOrFail($id);
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
        }

        $companyProfile = CompanyProfile::findOrFail($id);
            $companyProfile->address    = $validatedData['edit_address'];
            $companyProfile->city       = $validatedData['edit_city'];
            $companyProfile->zip        = $validatedData['edit_zip'];
            $companyProfile->phone      = $validatedData['edit_phone'];
            $companyProfile->color      = $validatedData['edit_color'];

            if(!$this->edit_logo == null)
            {
                $companyProfile->logo       = $media->id;
            }

            if($validatedData['edit_state'] == null)
            {
                $companyProfile->state_id   = $this->edit_state;
            }
             else 
            {
                $companyProfile->state_id   = $validatedData['edit_state'];
            }
            
            $companyProfile->save();

        return redirect('/');
    }

}
