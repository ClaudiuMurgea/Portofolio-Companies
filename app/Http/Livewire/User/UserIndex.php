<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Facility;
use App\Models\Company;

class UserIndex extends Component
{   
    use WithPagination;
    // public $users;
    public $company;
    public $corporateID;

    public $facilityUsers;
    public $searchTerm;

    protected $listeners = ['show'];

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

    public function mount ()
    {
        // $this->users = User::all();

        if( auth()->user()->hasRole('Corporate Admin') )
        {
            $this->corporateID = auth()->user()->companyAdmin->first()->company_id;
                $this->company = Company::find($this->corporateID);
                    foreach($this->company->facilities as $facility)
                    {
                        foreach($facility->facilityUsers as $user)
                        {
                            $this->facilityUsers[] = $user->user_id;         
                        }
                    }
            }
    }

    public function render()
    {   
        return view('livewire.user.user-index', ['users' => User::where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%')
                      ->orWhere('email', 'like', '%'.$this->searchTerm. '%');
        })->paginate(10)
        ])->layout('layouts.admin.master');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users');
    }
}
