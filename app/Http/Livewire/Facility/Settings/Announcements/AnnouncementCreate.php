<?php

namespace App\Http\Livewire\Facility\Settings\Announcements;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Announcement;

class AnnouncementCreate extends Component
{
    protected $rules = [
        'title'             => 'required',
        'text'              => 'required',
        'first_date'  => 'required|date',
        'second_date' => 'required|date'
        ];

    public $return = false;
    public $active = true;

    public $facilityID;
    
    public $title;
    public $text;
    public $first_date;
    public $second_date;
    
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
        return view('livewire.facility.settings.announcements.announcement-create')->layout('layouts.admin.master');
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
            $announcement->start_at     = $this->first_date;
            $announcement->end_at       = $this->second_date;
            $announcement->save();
        
        $this->back();
    }

}
