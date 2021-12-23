<?php

namespace App\Http\Livewire\Company\Settings\Announcements;

use Livewire\Component;
use App\Models\Company;
use App\Models\Announcement;

class CompanyAnnouncementsIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;

    public $company;
    public $announcementID;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function edit ($announcement)
    {
        $this->announcementID = $announcement;
        $this->show('showEdit', $this->announcementID);
    }

    public function mount ($company)
    {
        $this->company = Company::findOrFail($company);
    }

    public function render()
    {
        $announcements = Announcement::where('company_id', $this->company->id)->get();
        return view('livewire.company.settings.announcements.company-announcements-index', ['announcements' => $announcements])->layout('layouts.admin.master');
    }
    
    public function delete($id)
    {
        $announcement = Announcement::findOrFail($id);
            $announcement->delete();
    }
}
