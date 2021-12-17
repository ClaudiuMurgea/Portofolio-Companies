<?php

namespace App\Http\Livewire\Facility\Settings\Displays;

use Livewire\Component;
use App\Models\Display;
use App\Models\DisplayType;
use App\Models\Media;
use Livewire\WithFileUploads;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class DisplayEdit extends Component
{   
    use WithFileUploads;

    public $return = false;
    public $active = true;
    public $showColor  = false;
    public $showImage  = false;

    public $facilityID;

    public $displays;
    public $displayTypes;

    public $radio;
    public $edit_name;
    public $edit_type;
    public $edit_orientation;
    public $edit_color;
    public $old_image;
    public $image;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }
    
    public function option ($type)
    {
        $this->showColor = false;
        $this->showImage = false;
        $this->$type = true;
    }

    public function mount($facility)
    {
        $this->facilityID = $facility;
        $this->displays = Display::all();
        $this->displayTypes = DisplayType::all();

        $display = Display::with('Media')->where('facility_id', $facility)->first();
            $this->edit_name        = $display->name;
            $this->edit_type        = $display->display_type;
            $this->edit_orientation = $display->horizontal;
            $this->edit_color       = $display->color_code;
    }

    public function render()
    {
        return view('livewire.facility.settings.displays.display-edit')->layout('layouts.admin.master');
    }

    public function edit($id)
    {
        $this->validate([
            'edit_name'        => 'required',
            'edit_type'        => 'required',
            'edit_orientation' => 'required',
            'edit_color'       => 'required_if:image,null',
            'image'            => 'required_if:edit_color,null'
        ]);

        $display = Display::find($id);

        if($display->media_id == true)
        {
            $media = Media::find($display->media_id);
            $this->old_image = $media->url;
        }

        $display = Display::findOrFail($id);
            $display->name         = $this->edit_name;
            $display->display_type = $this->edit_type;
            $display->horizontal   = $this->edit_orientation;

            if($this->edit_color == true)
            {
                $display->color_code = $this->edit_color;
            }

            if($this->image == true)
            {
                if(File::exists("storage/$this->old_image"))
                {
                    File::delete("storage/$this->old_image");
                }
            
                $media = new Media();
                $filename = $this->image->store('photos', 'public');
                $media->url = $filename;
                $media->save();
                    $manager = new ImageManager();
                    $image = $manager->make('storage/'.$filename)->resize(523.2, 255.66);
                    $image->save('storage/'.$filename);
                
                $display->media_id = $media->id;
            }

        $display->save();
        $this->back();
    }
}
