<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayCreate extends Component
{
    protected $rules = [ 
        'name' => 'required|unique:display_types,name'
     ];

    public $name;

    public $return = false;
    public $active = true;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }
 
    public function render ()
    {
        return view('livewire.display.display-create')->layout('layouts.admin.master');
    }

    public function create ()
    {
        $this->validate();
        
        $displayType = new DisplayType();
            $displayType->name = ucfirst($this->name);
            $displayType->save();

        $this->back();
    }
}
