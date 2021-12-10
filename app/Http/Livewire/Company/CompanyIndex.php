<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Company;
use App\Models\Facility;
use App\Models\CompanyAdmin;
use App\Models\CompanyProfile;

class CompanyIndex extends Component
{   
    use WithPagination;
    public $searchTerm;
    public $companyDetails;
    
    public $corporateID;
    public $userCompany;
    public $corporateAdmin;

    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;


    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function details ($ids)
    {
        $this->showDetails = true;
        $this->companyDetails = Company::find($ids);
    }

    public function mount ()
    {   
        $this->corporateAdmin = CompanyAdmin::where( 'user_id', auth()->user()->id )->first();

        if( auth()->user()->hasAnyRole('Corporate Admin|Facility Admin|Facility Editor') )
        {
            if( $this->corporateAdmin == null )
            {            
                $this->corporateID = auth()->user()->facilityUsers->first()->facility->company_id;
            }
            else
            {
                $this->corporateID = auth()->user()->companyAdmin->first()->company_id;
            }

            $this->userCompany = Company::find($this->corporateID);            
        }
    }

    public function render ()
    {   
        return view('livewire.company.company-index', ['companies' => Company::where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%');
        })->paginate(12)
        ])->layout('layouts.admin.master');
    }

    public function destroy ($id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);
            $companyProfile->Media->delete();
            $companyProfile->delete();
        
        $facilities = Facility::where('company_id', $id)->get();
            foreach ($facilities as $facility)
            {   
                if (!$facility->FacilityUsers == null )
                {
                    foreach($facility->facilityUsers as $user)
                    {
                        $user = User::find($user->id);
                        $user->active = 0;
                        $user->save();
                    }
                }
                if (!$facility->Profile->Media)
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
        
        // $companyAdmin = CompanyAdmin::where('company_id', $id)->get();
        // $user = User::find()
            
        return redirect('/');
    }
}
