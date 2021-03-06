<?php

namespace App\Http\Livewire\Facility\Settings\Announcements;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementsIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;

    public $facilityID;
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

    public function mount ($facility)
    {
        $this->facilityID = $facility;

    }

    public function render()
    {
        $announcements = Announcement::where('facility_id', $this->facilityID)->get();
        return view('livewire.facility.settings.announcements.announcements-index', ['announcements' => $announcements])->layout('layouts.admin.master');
    }

    public function delete ($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
    }
}
