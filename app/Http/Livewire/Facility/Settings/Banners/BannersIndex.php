<?php

namespace App\Http\Livewire\Facility\Settings\Banners;

use Livewire\Component;

class BannersIndex extends Component
{
    public function render()
    {
        return view('livewire.facility.settings.banners.banners-index')->layout('layouts.admin.master');
    }

    public function mount ($facility)
    {
    }
}
