<?php

namespace App\Http\Livewire\Company\Settings\Announcements;

use Livewire\Component;
use App\Models\Announcement;

class CompanyAnnouncementEdit extends Component
{
    public $edit_title;
    public $edit_text;
    public $start_date;
    public $end_date;

    public $announcement;
    public $announcementID;

    public $return = false;
    public $active = true;
    public $companyID;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount($announcement)
    {   
        $this->announcement = Announcement::find($announcement);
            $this->announcementID = $announcement;
            $this->companyID   = $this->announcement->company_id;
            $this->edit_title  = $this->announcement->title;
            $this->edit_text   = $this->announcement->announcement;
            $this->start_date  = $this->announcement->start_at;
            $this->end_date    = $this->announcement->end_date;
    }

    public function render()
    {
        return view('livewire.company.settings.announcements.company-announcement-edit')->layout('layouts.admin.master');
    }

    public function edit ($id)
    {
        $this->validate([
            'edit_title'  => 'required|max:255',
            'edit_text'   => 'required|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date'
        ]);

        $announcement = Announcement::find($id);
            $announcement->title        = $this->edit_title;
            $announcement->announcement = $this->edit_text;
            $announcement->start_at     = $this->start_date;
            $announcement->end_at       = $this->end_date;
            $announcement->save();
        
        $this->back();
    }
}
