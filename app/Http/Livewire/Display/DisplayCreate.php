<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayCreate extends Component
{
    protected $rules = [ 'name' => 'required|unique:display_types,name' ];

    public $name;
 
    public function render ()
    {
        return view('livewire.display.display-create')->layout('layouts.admin.master');
    }

    public function create ()
    {
        $validatedData = $this->validate();
        
        $displayType = new DisplayType();
            $displayType->name = $validatedData['name'];
            $displayType->save();

        return redirect('/displays');
    }
}
