<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use App\Models\Company;


class StoreVideoBanner extends Component
{
    use WithFileUploads;
    public $ids;
    public $name;
    public $media_id;
    public $companyID;
    public $video;

    public function render()
    {
        return view('livewire.banner.store-video-banner')->layout('layouts.admin.master');
    }

    public function storeVideo ($companyID)
    {   
        // $this->ids = $companyID;
        // $v = $this->validate();
        dd($v);
        $banner = new Banner();
        $banner->company_id = $ids;
        $banner->name = 'hey';
        $banner->media_id = 1;
        $banner->save();

        // $media = new Media();
        //     $filename = $this->logo->store('photos', 'public');
        //     $media->url = $filename;
        //     $media->save();
    }
}
