<?php

namespace App\Http\Livewire\Facility\Settings\Positions;

use Livewire\Component;
use App\Models\Position;

class PositionsIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;
    public $announcements;

    public $facilityID;
    public $positionID;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function edit ($position)
    {
        $this->positionID = $position;
        $this->show('showEdit', $this->positionID);
    }
  
    public function mount ($facility)
    {
        $this->facilityID = $facility;
    }

    public function render()
    {
        $positions = Position::where('facility_id', $this->facilityID)->get();
        return view('livewire.facility.settings.positions.positions-index', ['positions' => $positions])->layout('layouts.admin.master');
    }

    public function delete ($id)
    {
        $position = Position::find($id);
        $position->delete();
    }

}
