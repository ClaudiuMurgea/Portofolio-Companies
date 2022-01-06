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

    public $facilityID;
    public $title;
    public $banner;
    public $start_at;
    public $end_at;
    public $hour;
    public $minute;
    public $meridiem;
    public $end_hour;
    public $end_minute;
    public $end_meridiem;

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
        return view('livewire.facility.settings.banners.banner-create')->layout('layouts.admin.master');
    }

    public function create ($id)
    {
        $this->validate([
            'title'        => 'required',
            'banner'       => 'required|mimes:jpg,jpeg,png|max:40960',
            'start_at'     => 'required',
            'hour'         => '',
            'minute'       => '',
            'meridiem'     => '',
            'end_at'       => '',
            'end_hour'     => '',
            'end_minute'   => '',
            'end_meridiem' => ''
        ]);

        $banner = new Banner();
            $facility = Facility::find($id);
            $banner->company_id = $facility->company_id;
            $banner->facility_id = $id;
            $banner->name = $this->title;

            if($this->meridiem == 'pm')
            {
                $this->hour *= 2;
            } 
            $banner->start_at = $this->start_at . ' ' . $this->hour . ':' . $this->minute;

            if($this->end_meridiem = 'pm')
            {
                $this->end_hour *= 2;
            }
            $banner->end_at = $this->end_at . ' ' . $this->end_hour . ':' . $this->end_minute;

            $media = new Media();
            $filename = $this->banner->store('photos', 'public');
            $media->url = $filename;
            $media->save();
                $manager = new ImageManager();
                $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
                $image->save('storage/'.$filename);
            $banner->media_id = $media->id; 

            $banner->save();

        $this->back();
    }   
}
