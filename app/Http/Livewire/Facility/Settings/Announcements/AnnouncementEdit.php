<?php

namespace App\Http\Livewire\Facility\Settings\Announcements;

use Livewire\Component;

class AnnouncementEdit extends Component
{
    public function render()
    {
        return view('livewire.facility.settings.announcements.announcement-edit')->layout('layouts.admin.master');
    }
}
