<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Facility;
use Livewire\WithFileUploads;

class CompanyComponent extends Component
{   
    use WithFileUploads;

    protected $listeners = ['show', 'update'];

    public $ids;
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;

    public function show ($type, $ids = null)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function render ()
    {
        return view('livewire.company.company-component')->layout('layouts.admin.master');
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
            
        return redirect('/');
    }
}
