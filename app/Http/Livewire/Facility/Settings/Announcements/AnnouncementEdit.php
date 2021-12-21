<?php

namespace App\Http\Livewire\Facility\Settings\Announcements;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementEdit extends Component
{
    public $edit_title;
    public $edit_text;
    public $first_date;
    public $second_date;

    public $announcement;
    public $announcementID;

    public $return = false;
    public $active = true;
    public $facilityID;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($announcement)
    {   
        $this->announcement = Announcement::find($announcement);
            $this->announcementID = $announcement;
            $this->facilityID  = $this->announcement->facility_id;
            $this->edit_title  = $this->announcement->title;
            $this->edit_text   = $this->announcement->announcement;
            $this->first_date  = $this->announcement->start_at;
            $this->second_date = $this->announcement->end_date;
    }

    public function render()
    {
        return view('livewire.facility.settings.announcements.announcement-edit')->layout('layouts.admin.master');
    }

    public function edit ($id)
    {
        $this->validate([
            'edit_title'  => 'required',
            'edit_text'   => 'required',
            'first_date'  => 'required',
            'second_date' => 'required'
        ]);

        $announcement = Announcement::find($id);
            $announcement->title        = $this->edit_title;
            $announcement->announcement = $this->edit_text;
            $announcement->start_at     = $this->first_date;
            $announcement->end_at       = $this->second_date;
            $announcement->save();
        
        $this->back();
    }
}
