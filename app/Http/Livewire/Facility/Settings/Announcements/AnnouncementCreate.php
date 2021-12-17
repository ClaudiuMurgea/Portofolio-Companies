<?php

namespace App\Http\Livewire\Facility\Settings\Announcements;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Announcement;

class AnnouncementCreate extends Component
{
    protected $rules = [
        'title'       => 'required',
        'text'        => 'required',
        'datepicker1' => 'required|date',
        'datepicker2' => 'required|date'
        ];

    public $return = false;
    public $active = true;

    public $facilityID;
    
    public $title;
    public $text;
    public $datepicker1;
    public $datepicker2;
    
    public function mount($facility)
    {
        $this->facilityID = $facility;
    }

    public function render()
    {
        return view('livewire.facility.settings.announcements.announcement-create')->layout('layouts.admin.master');
    }

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function create ($id)
    {
        $this->validate();
        
        $announcement = new Announcement();
            $facility = Facility::find($id);
            $announcement->company_id   = $facility->company_id;
            $announcement->facility_id  = $this->facilityID;
            $announcement->title        = $this->title;
            $announcement->announcement = $this->text;
            $announcement->start_at     = $this->datepicker1;
            $announcement->end_at       = $this->datepicker2;
            $announcement->save();
        
        $this->back();
    }

}
