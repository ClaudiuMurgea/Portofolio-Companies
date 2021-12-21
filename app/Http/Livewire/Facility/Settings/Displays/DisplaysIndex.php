<?php

namespace App\Http\Livewire\Facility\Settings\Displays;

use Livewire\Component;
use App\Models\Display;
use Illuminate\Support\Facades\File;

class DisplaysIndex extends Component
{
    public $ids;
    public $showIndex   = true;
    public $showCreate  = false;
    public $showEdit    = false;
    public $showDetails = false;
    // public $displays;

    public $facilityID;
    public $displayID;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;      
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function edit ($display)
    {
        $this->displayID = $display;
        $this->show('showEdit', $this->displayID);
    }

    public function render()
    {
        $displays = Display::where('facility_id', $this->facilityID)->get();
        return view('livewire.facility.settings.displays.displays-index', ['displays' => $displays])->layout('layouts.admin.master');
    }

    public function mount ($facility)
    {
        // $this->displays = Display::all();
        $this->facilityID = $facility;
    } 

    public function delete ($id)
    {
        $display = Display::find($id);
        
        if( isset($display->media_id) )
        {
            $imageName = $display->media->url;

            if( File::exists("storage/$imageName") )
            {
                File::delete("storage/$imageName");
            }

            $display->media->delete();
        }
        $display->delete();
    }
}
