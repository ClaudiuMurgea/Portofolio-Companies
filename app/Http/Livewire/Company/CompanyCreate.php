<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\User;
use App\Models\State;
use App\Models\Media;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyAdmin;
use Livewire\WithFileUploads;

class CompanyCreate extends Component
{
    use WithFileUploads;

    public $states;

    public $name;
    public $company_id;
    public $address; 
    public $city;
    public $zip;
    public $state;
    public $phone;
    public $color;
    public $logo;

    public function mount ()
    {
        $this->states = State::all();
    }

    public function render ()
    {   
        return view('livewire.company.company-create');
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

        // $this->emit('saved');
        return redirect('/companies');
    }
}
