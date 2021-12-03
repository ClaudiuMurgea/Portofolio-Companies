<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use App\Models\Region;

class RegionIndex extends Component
{   
    public $regions;

    public function mount ()
    {
        $this->regions = Region::all();
    }

    public function render()
    {
        return view('livewire.region.region-index')->layout('layouts.admin.master');
    }
}
