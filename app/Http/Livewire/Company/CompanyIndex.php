<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;

class CompanyIndex extends Component
{   
    public $companies;
    public $showIndex = true;
    public $showCreate = false;
    public $showEdit = false;

    public function showCreate ()
    { 
        $this->showIndex  = false;
        $this->showCreate = true;
    }

    public function mount ()
    {   
        $this->companies = Company::all();
    }

    public function render()
    {
        return view('livewire.company.company-index')->layout('layouts.admin.master');
    }

    
}
