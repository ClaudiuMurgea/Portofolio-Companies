<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Media;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

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

    public $selectedBanner;
    public $selectedCompany;

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

    public function select($id)
    {   
        $this->selectedBanner  = Banner::find($id);
        $this->selectedCompany = CompanyProfile::where('company_id', $this->ids)->first();
        $this->selectedCompany->logo = $this->selectedBanner->media->id;
        $this->selectedCompany->save();
        redirect ('/banners/' . $this->ids)->with('message', 'Active Banner succesfully updated!');
    }

    public function delete($id)
    {
        $selectedBanner  = Banner::find($id);
        $selectedCompany = CompanyProfile::where('company_id', $this->ids)->first();

        if($selectedBanner->media->id == $selectedCompany->logo)
        {
            return redirect('/banners/' . $this->ids)->with('message', 'Active Banner cannot be deleted!');
        } 
        else 
        {
            if(File::exists("storage/$selectedBanner->name"))
            {
                File::delete("storage/$selectedBanner->name");
            }
            else 
            {
                dd('File does not exists.');
            }
        }

        $selectedBanner->media->delete();
        $selectedBanner->delete();
        return redirect('/banners/' . $this->ids)->with('message', 'Banner succesfully deleted!');
    }

    // public function storeVideo ($ids)
    // {   
    //     $v = $this->validate();
    //     dd($v);
    //     $banner = new Banner();
    //     $banner->company_id = $ids;
    //     $banner->name = 'hey';
    //     $banner->media_id = 1;
    //     $banner->save();

    //     $media = new Media();
    //         $filename = $this->logo->store('photos', 'public');
    //         $media->url = $filename;
    //         $media->save();
    // }

    // public function store ($ids)
    // {   
    //     $v = $this->validate([
    //         'dropzone' => 'file'
    //     ]);
    //     dd($v);
    //     $banner = new Banner();
    //     $banner->company_id = $ids;
    //     $banner->name = 'hey';
    //     $banner->media_id = 1;
    //     $banner->save();

    //     $media = new Media();
    //         $filename = $this->logo->store('photos', 'public');
    //         $media->url = $filename;
    //         $media->save();
    // }


}
