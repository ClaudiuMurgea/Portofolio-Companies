<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use App\Models\Company;
use Illuminate\Support\Facades\File;

class BannerComponent extends Component
{
    use WithFileUploads;

    public $ids;
    public $name;
    public $media_id;
    public $file;
    public Company $company;

    public $showVideo  = false;
    public $showImage = false;
    public $dropzone;
    public $allLogos;
    public $logoNames;
    public $companyBanners;

    protected $rules = [
        'dropzone' => '',
    ];

    public function show($type)
    {
        $this->showVideo  = false;
        $this->showImage = false;  

        $this->$type      = true;
    }

    public function mount($company)
    {
        $this->ids = $company->id;
        $this->companyBanners = Banner::where('company_id', $this->ids)->get();
        // dd($this->companyBanners);
        // $this->allLogos = File::allFiles(public_path('images'));
        // foreach($this->allLogos as $logo)
        // {
        //     dd($logo->getRelativePathname());
        //     $this->logoNames[] = $logo->getRelativePathname();
        // }
        // dd($this->logoNames);
        
    }

    public function render()
    {   
        return view('livewire.banner.banner-component')->layout('layouts.admin.master');
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
        $v = $this->validate([
            'dropzone' => 'file'
        ]);
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
