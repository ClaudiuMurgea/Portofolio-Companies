<?php

namespace App\Http\Livewire;

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


class LiveCompany extends Component
{   
    use WithFileUploads;

    protected $rules = [
        'edit_state' => '',
    ];

    public $selectData=true;
    public $createData=false;
    public $updateData=false;

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

    public $edit_name;
    public $edit_company_id;
    public $edit_address; 
    public $edit_city;
    public $edit_zip;
    public $edit_state;
    public $edit_phone;
    public $edit_color;
    public $edit_logo;


    public function render ()
    {   
        $states = State::all();
        $companies = Company::all();

        return view('livewire.live-company', ['states' => $states, 'companies' => $companies])->layout('layouts.admin.master');
    }


    public function resetFields ()
    {
        $this->name     ="";
        $this->address  ="";
        $this->city     ="";
        $this->zip      =""; 
        $this->state    ="";
        $this->phone    ="";
        $this->color    ="";
        $this->logo     ="";
    }


    public function showForm ()
    {   
        $this->createData=true;
        $this->selectData=false; 
    }


    public function create ()
    {
        $validatedData = $this->validate([
            'name'          => 'required|unique:companies,name|max:100',
            'address'       => 'required|max:100',
            'city'          => 'required|max:100',
            'zip'           => 'required|numeric',
            'state'         => 'required',
            'phone'         => 'required|numeric',
            'color'         => 'required|max:20',
            'logo'          => 'required|mimes:jpg,jpeg,png|max:20480'
        ]);

        $company = new Company();
            $company->name = $validatedData['name'];
            $company->save();

        $companyAdmin = new CompanyAdmin();
            $user = User::find(auth()->user()->id);
            $companyAdmin->user_id = $user->id;
            $companyAdmin->company_id = $company->id;
            $companyAdmin->save();

        $media = new Media();
            $filename = $this->logo->store('photoss');
            $media->url = $filename;
            $media->save();

        $companyProfile = new CompanyProfile();
            $companyProfile->company_id = $company->id;
            $companyProfile->address    = $validatedData['address'];
            $companyProfile->city       = $validatedData['city'];
            $companyProfile->zip        = $validatedData['zip'];
            $companyProfile->state_id   = $validatedData['state'];
            $companyProfile->phone      = $validatedData['phone'];
            $companyProfile->color      = $validatedData['color'];
            $companyProfile->logo       = $media->id;
            $companyProfile->save();

        $this->selectData = true;
        $this->createData = false;
        $this->resetFields();
    }


    public function edit ($id)
    {   
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

        $company = Company::findOrFail($id);
            $this->edit_name = $company->name;
            $this->ids = $company->id;

        $companyProfile = CompanyProfile::findOrFail($id);
            $this->edit_address = $companyProfile->address;
            $this->edit_city    = $companyProfile->city;
            $this->edit_zip     = $companyProfile->zip;
            $this->edit_state   = $companyProfile->state;
            $this->edit_phone   = $companyProfile->phone;
            $this->edit_color   = $companyProfile->color;

        $media = Media::findOrFail($id);
            $this->edit_logo = $media->url;
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
