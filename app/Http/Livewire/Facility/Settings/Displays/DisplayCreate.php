<?php

namespace App\Http\Livewire\Facility\Settings\Displays;

use Livewire\Component;
use App\Models\Display;
use App\Models\DisplayType;
use App\Models\Media;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;
    
class DisplayCreate extends Component
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
    public $name;
    public $type;
    public $orientation;
    public $color;
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
    }

    public function render()
    {
        return view('livewire.facility.settings.displays.display-create')->layout('layouts.admin.master');
    }

    public function create($id)
    {   
        $this->validate([
            'name'        => 'required',
            'type'        => 'required',
            'orientation' => 'required',
            'color'       => 'required_if:image,null',
            'image'       => 'required_if:color,null'
        ]);

        $display = new Display();
            $display->facility_id  = $id;
            $display->name         = $this->name;
            $display->display_type = $this->type;
            $display->horizontal   = $this->orientation;
            $display->identifier  = time();
            $display->vpn_ip = 1;

            if($this->color == true)
            {
                $display->color_code = $this->color;
            }
            if($this->image == true)
            {   
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
