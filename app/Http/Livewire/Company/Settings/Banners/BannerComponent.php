<?php

namespace App\Http\Livewire\Company\Settings\Banners;

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
    public $media;
    public $media_id;
    public $file;
    public $company;

    public $showVideo  = false;
    public $showImage = false;
    public $dropzone;
    public $allLogos;
    public $logoNames;

    public $selectedBanner;
    public $selectedCompany;

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

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
        $this->ids = $company;
        $this->company = Company::findOrFail($this->ids);
        $this->media = Media::all();
    }

    public function render()
    {   
        $companyBanners = Banner::where('company_id', $this->ids)->get();
        return view('livewire.company.settings.banners.banner-component', ['companyBanners' => $companyBanners])->layout('layouts.admin.master');
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
            session()->now('message', 'Active Banner cannot be deleted!');
            return view('livewire.company.settings.banners.banner-component');
        } 
        else 
        {
            if(File::exists("storage/$selectedBanner->name"))
            {
                File::delete("storage/$selectedBanner->name");
            }
        }

        $selectedBanner->media->delete();
            $selectedBanner->delete();
    }
}
