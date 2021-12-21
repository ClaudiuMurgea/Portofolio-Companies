<?php

namespace App\Http\Livewire\Facility\Settings\Banners;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Banner;
use App\Models\Media;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class BannerCreate extends Component
{
    use WithFileUploads;

    protected $rulles = [
        'title' => 'required',
        'banner' => 'required',
        'start_at' => 'required',
        'end_at' => '',
        'options' => ''
    ];

    public $facilityID;
    public $title;
    public $banner;
    public $start_at;
    

    public $return = false;
    public $active = true;

    public $options;
    public $expireDate = false;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function expireDate()
    {
        $this->expireDate = true;
    }

    public function mount ($facility)
    {
        $this->facilityID = $facility;
    }

    public function render()
    {
        if($this->options == 1)
        {
            $this->expireDate();
        }

        return view('livewire.facility.settings.banners.banner-create')->layout('layouts.admin.master');
    }

    public function create ($id)
    {
        $banner = new Banner();
            $facility = Facility::find($id);
            $banner->company_id = $facility->company_id;
            $banner->facility_id = $id;
            $banner->name = $this->title;

            $media = new Media();
            $filename = $this->banner->store('photos', 'public');
            $media->url = $filename;
            $media->save();
                $manager = new ImageManager();
                $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
                $image->save('storage/'.$filename);
            $banner->media_id = $media->id; 
            $banner->start_at = $this->start_at;
            $banner->save();

        $this->back();
    }   
}
