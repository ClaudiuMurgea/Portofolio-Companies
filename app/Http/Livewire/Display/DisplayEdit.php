<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayEdit extends Component
{
    public $ids;
    public $edit_name;
    
    public $return = false;
    public $active = true;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function render()
    {
        return view('livewire.display.display-edit')->layout('layouts.admin.master');
    }

    public function mount ($displayTypeID)
    {
        $displayType = DisplayType::findOrFail($displayTypeID);
            $this->edit_name = $displayType->name;
            $this->ids = $displayTypeID;
    }

    public function update ($id)
    {
        $this->validate([
            'edit_name' => 'required|unique:display_types,name,' . $id
        ]);

        $displayType = DisplayType::findOrFail($id);
            $displayType->name = $this->edit_name;
            $displayType->save();

        $this->back();
    }
}
