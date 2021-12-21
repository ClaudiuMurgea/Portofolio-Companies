<?php

namespace App\Http\Livewire\Facility\Settings\Positions;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Position;

class PositionEdit extends Component
{
    public $edit_description;
    public $edit_title;
    public $edit_url;
    public $edit_date;
    public $image;

    public $positionID;
    public $position;
    public $facilityID;

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($position)
    {
        $this->positionID = $position;
        $this->position = Position::find($position);
        $this->facilityID = $this->position->facility_id;
        $this->edit_description = $this->position->description;
        $this->edit_title = $this->position->name;
        $this->edit_date = $this->position->expire_date;
    }

    public function render()
    {
        return view('livewire.facility.settings.positions.position-edit')->layout('layouts.admin.master');
    }

    public function edit($id)
    {
        $this->validate([
            'edit_title'       => 'required',
            'edit_description' => 'required',
            'edit_url'         => 'required',
            'edit_date'        => 'required',
            'image'            => 'required'
        ]);

        $facility = Facility::find($this->facilityID);
        $position = Position::find($id);
            $position->facility_id = $facility->id;
            $position->company_id  = $facility->company_id;
            $position->name =   $this->edit_title;
            $position->description = $this->edit_description;
            $position->pos_image = $this->image;
            $position->expire_date = $this->edit_date;
            $position->save();
        
        $this->back();
    }
}
