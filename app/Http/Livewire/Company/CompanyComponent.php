<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\State;

class CompanyComponent extends Component
{   
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;
    public $ids;
    protected $listeners = ['show'];


    
    public function show ($type, $ids = null)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;
        $this->ids = $ids;
       
        $this->$type = true;
    }

    public function render()
    {
        return view('livewire.company.company-component')->layout('layouts.admin.master');
    }
}
