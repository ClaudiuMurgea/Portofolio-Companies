<?php

namespace App\Http\Livewire\Company\Settings\Announcements;

use Livewire\Component;
use App\Models\Company;
use App\Models\Announcement;

class CompanyAnnouncementCreate extends Component
{
    public $return = false;
    public $active = true;

    public $companyID;
    public $company;
    
    public $title;
    public $text;
    public $start_date;
    public $end_date;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }
    
    public function mount($company)
    {
        $this->companyID = $company;
        $this->company   = Company::findOrFail($company);
    }

    public function render()
    {
        return view('livewire.company.settings.announcements.company-announcement-create')->layout('layouts.admin.master');
    }

    public function create ($id)
    {
        $this->validate([
            'title'       => 'required|max:255',
            'text'        => 'required|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date'
        ]);
        
        $announcement = new Announcement();
            $announcement->company_id   = $this->companyID;
            $announcement->title        = $this->title;
            $announcement->announcement = $this->text;
            $announcement->start_at     = $this->start_date;
            $announcement->end_at       = $this->end_date;
            $announcement->save();
        
        $this->back();
    }
}
