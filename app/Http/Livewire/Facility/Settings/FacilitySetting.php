<?php

namespace App\Http\Livewire\Facility\Settings;

use Livewire\Component;
use App\Models\Facility;
use App\Models\ScheduleTypes;

class FacilitySetting extends Component
{   
    public Facility $facility;

    protected $rulles = [
        'scheduleType' => ''
    ];

    public $scheduleType;
    public $scheduleTypes;
    public $facilityID;
    public $ids;

    public $weekly;
    public $bi_weekly;
    public $tri_weekly;
    public $monthly;

    public $showMenus          = true;
    public $showDisplays       = false;
    public $showPositions      = false;
    public $showAnnouncements  = false;
    public $showBanners        = false;

    public function show ( $type, $ids = null )
    {
        $this->showMenus         = false;
        $this->showDisplays      = false;
        $this->showPositions     = false;
        $this->showAnnouncements = false;
        $this->showBanners       = false;

        $this->$type = true;
        $this->ids   = $ids;
    }

    public function Only ($type)
    {   
        $this->weekly     = false;
        $this->bi_weekly  = false;
        $this->tri_weekly = false;
        $this->monthly    = false;

        $this->$type = true;
    }

    public function mount ($facility)
    {   
        $this->facilityID = $facility->id;
        $this->scheduleTypes = ScheduleTypes::all();
    }

    public function render ()
    {
        foreach($this->scheduleTypes as $type)
        {
            if(!empty($this->scheduleType) )
            {   
                if(strpos( $this->scheduleType, "-" ))
                {
                    $changedName = str_replace("-", "_", $this->scheduleType);
                }
                else
                {
                    $changedName = $this->scheduleType;
                }
                $this->only($changedName);
            }
        }
   
        foreach($this->scheduleTypes as $DBscheduleType)
        {
            if( $this->scheduleType == $DBscheduleType->name )
            {   
                dd(1);
            }
        }

        return view('livewire.facility.settings.facility-setting')->layout('layouts.admin.master');
    }
}
