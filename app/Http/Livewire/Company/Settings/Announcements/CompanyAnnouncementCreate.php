<?php

namespace App\Http\Livewire\Company\Settings\Announcements;

use Livewire\Component;
use App\Models\Company;
use App\Models\Announcement;

class CompanyAnnouncementCreate extends Component
{
    // protected $rules = [

    //     ];

    public $return = false;
    public $active = true;

    public $companyID;
    
    public $title;
    public $text;
    public $first_date;
    public $second_date;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }
    
    public function mount($company)
    {
        $this->companyID = $company;
    }

    public function render()
    {
        return view('livewire.company.settings.announcements.company-announcement-create')->layout('layouts.admin.master');
    }

    public function create ($id)
    {
        $this->validate([
            'title'       => 'required',
            'text'        => 'required',
            'first_date'  => 'required|date',
            'second_date' => 'required|date'
        ]);
        
        $announcement = new Announcement();
            $announcement->company_id   = $this->companyID;
            $announcement->title        = $this->title;
            $announcement->announcement = $this->text;
            $announcement->start_at     = $this->first_date;
            $announcement->end_at       = $this->second_date;
            $announcement->save();
        
        $this->back();
    }
}
