<?php

namespace App\Http\Livewire\Facility\Settings;

use Livewire\Component;

class Test extends Component
{
    public $datepicker;
    
    public function render()
    {
        return view('livewire.facility.settings.test')->layout('layouts.admin.master');
    }
}
