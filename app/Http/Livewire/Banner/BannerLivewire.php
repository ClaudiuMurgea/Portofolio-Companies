<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use App\Models\Company;

class BannerLivewire extends Component
{   
    use WithFileUploads;

    public $ids;
    public $name;
    public $media_id;
    public Company $company;

    public $showVideo  = false;
    public $showImage = false;

    public function show($type)
    {
        $this->showVideo  = false;
        $this->showImage = false;  

        $this->$type      = true;
    }

    public function mount($company)
    {
        $this->ids = $company->id;
    }

    public function render()
    {
        return view('livewire.banner.banner-livewire')->layout('layouts.admin.master');
    }

    public function storeVideo ($ids)
    {   
        $v = $this->validate();
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

    public function store ($ids)
    {   
        $v = $this->validate();
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
