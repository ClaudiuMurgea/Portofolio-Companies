<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayIndex extends Component
{   
    public $displayTypes;

    public function mount ()
    {
        $this->displayTypes = DisplayType::all();
    }

    public function render()
    {
        return view('livewire.display.display-index')->layout('layouts.admin.master');
    }
}
