<?php

namespace App\Http\Livewire\Facility\Settings\Menus;

use Livewire\Component;
use App\Models\Facility;
use App\Models\ScheduleTypes;

class MenusIndex extends Component
{
    public $facility;
    protected $rulles = [
        'scheduleType' => ''
    ];

    public $scheduleType;
    public $scheduleTypes;
    public $ids;

    public $Weekly;
    public $Bi_weekly;
    public $Tri_weekly;
    public $Monthly;

    public function Only ($type)
    {   
        $this->Weekly     = false;
        $this->Bi_weekly  = false;
        $this->Tri_weekly = false;
        $this->Monthly    = false;

        $this->$type = true;
    }

    public function mount ($facility)
    {
        $this->scheduleTypes = ScheduleTypes::all();
    }
    
    public function render()
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
        
        return view('livewire.facility.settings.menus.menus-index')->layout('layouts.admin.master');
    }

    public function create()
    {
        $this->validate([
            '$datepicker'=> ''
        ]);
        dd($this->validate);
    }
}
