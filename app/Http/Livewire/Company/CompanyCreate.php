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
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class CompanyCreate extends Component
{
    use WithFileUploads;

    protected $listeners = ['create'];

    protected $rules = [
        'name'    => 'required|unique:companies,name|max:100',
        'address' => 'required|max:100',
        'city'    => 'required|max:100',
        'zip'     => 'required|numeric',
        'state'   => 'required',
        'phone'   => 'required|numeric',
        'color'   => 'required|max:20',
        'logo'    => 'nullable|mimes:jpg,jpeg,png|max:20480' 
    ];

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

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount ()
    {   
        $this->states = State::all();
        $this->name     = "";
        $this->address  = "";
        $this->city     = "";
        $this->zip      = "";
        $this->state    = "";
        $this->phone    = "";
        $this->color    = "";
        $this->logo     = "";
    }

    public function render ()
    {     
        return view('livewire.company.company-create')->layout('layouts.admin.master');
    }

    public function create ()
    {
        $this->validate();

        $company = new Company();
            $company->name = $this->name;
            $company->save();

        $user = User::find( auth()->user()->id );
            $companyAdmin = new CompanyAdmin();
                $companyAdmin->user_id = $user->id;
                $companyAdmin->company_id = $company->id;
                $companyAdmin->save();

        $media = new Media();
            $filename = $this->logo->store('photos', 'public');
            $media->url = $filename;
            $media->save();
                $manager = new ImageManager();
                $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
                $image->save('storage/'.$filename);

        $companyProfile = new CompanyProfile();
            $companyProfile->company_id = $company->id;
            $companyProfile->address    = $this->address;
            $companyProfile->city       = $this->city;
            $companyProfile->zip        = $this->zip;
            $companyProfile->state_id   = $this->state;
            $companyProfile->phone      = $this->phone;
            $companyProfile->color      = $this->color;
            $companyProfile->logo       = $media->id;
            $companyProfile->save();

        $this->back();
    }
}
