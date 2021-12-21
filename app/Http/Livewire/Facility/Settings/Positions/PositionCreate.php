<?php

namespace App\Http\Livewire\Facility\Settings\Positions;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Position;

class PositionCreate extends Component
{
    public $description;
    public $title;
    public $url;
    public $date;
    public $image;

    public $facilityID;

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($facility)
    {
        $this->facilityID = $facility;
    }

    public function render()
    {
        return view('livewire.facility.settings.positions.position-create')->layout('layouts.admin.master');
    }

    public function create($id)
    {
        $this->validate([
            'title'       => 'required',
            'description' => 'required',
            'url'         => 'required',
            'date'        => 'required',
            'image'       => 'required'
        ]);

        $facility = Facility::find($id);
        $position = new Position();
            $position->facility_id = $facility->id;
            $position->company_id = $facility->company_id;
            $position->name = $this->title;
            $position->description = $this->description;
            $position->pos_image = $this->image;
            $position->expire_date = $this->date;
            $position->save();
        
        $this->back();
    }
}
