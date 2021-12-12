<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;

class StoreImageBanner extends Component
{
    public function render()
    {
        return view('livewire.banner.store-image-banner')->layout('layouts.admin.master');
    }
}
