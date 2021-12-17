<?php

namespace App\Http\Livewire\Facility\Settings\Positions;

use Livewire\Component;

class PositionsIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;
    public $announcements;

    public $facilityID;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function render()
    {
        return view('livewire.facility.settings.positions.positions-index')->layout('layouts.admin.master');
    }

    public function mount ($facility)
    {
        $this->facilityID = $facility;
    }
}
