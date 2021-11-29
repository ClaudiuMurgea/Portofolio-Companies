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

class CompanyEdit extends Component
{   
    use WithFileUploads;
    
    public $selectData=true;
    public $updateData=false;

    public $ids;
    public $states;
    
    public $edit_name;
    public $edit_company_id;
    public $edit_address; 
    public $edit_city;
    public $edit_zip;
    public $edit_state;
    public $edit_phone;
    public $edit_color;
    public $edit_logo;

    public function mount($mosad){
        $this->ids = $mosad;
        $company = Company::with(['Profile.Media'])->findOrFail($mosad);
        dd($company);
        $this->edit_name = $company->name;
        $this->ids = $company->id;

    
    $media = Media::findOrFail($mosad);
        $this->edit_logo = $media->url;
    }


    public function render()
    {   
      
    
        $this->states = State::all();

        return view('livewire.company.company-edit')->layout('layouts.admin.master');
    }

    public function edit ($id)
    {   
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

      
    }


    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name'          => 'required|unique:companies,name|max:100',
            'edit_address'       => 'required|max:100',
            'edit_city'          => 'required|max:100',
            'edit_zip'           => 'required|numeric',
            'edit_state'         => 'required',
            'edit_logo'          => 'required|mimes:jpg,jpeg,png|max:20480',
            'edit_phone'         => 'required|numeric',
            'edit_color'         => 'required|max:20'     
        ]);

        $company = Company::findOrFail($id);
            $company->name = $validatedData['edit_name'];
            $company->save();

        $media = Media::findOrFail($id);
            $filename = $this->edit_logo->store('photoss');
            $media->url = $filename;
            $media->save();

        $companyProfile = CompanyProfile::findOrFail($id);
            $companyProfile->address    = $validatedData['edit_address'];
            $companyProfile->city       = $validatedData['edit_city'];
            $companyProfile->zip        = $validatedData['edit_zip'];
            $companyProfile->state_id   = $validatedData['edit_state'];
            $companyProfile->phone      = $validatedData['edit_phone'];
            $companyProfile->color      = $validatedData['edit_color'];
            $companyProfile->logo       = $media->id;
            $companyProfile->save();

        $this->selectData = true;
        $this->updateData = false;
    }

    public function destroy ($id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);
            $companyProfile->Media->delete();
            $companyProfile->delete();

        
        $facilities = Facility::where('company_id', $id)->get();
            foreach ($facilities as $facility)
            {   
                if ($facility->Profile->Media)
                {
                    $facility->Profile->Media->delete();
                }
                 
                if ($facility->Profile)
                {
                    $facility->Profile->delete();
                }

                $facility->delete();
            }

        $company = Company::findOrFail($id);
            $company->delete();
    }

}
