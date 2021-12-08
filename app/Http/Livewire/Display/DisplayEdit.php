<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayEdit extends Component
{
    protected $rules = [ 'edit_name' => 'required|unique:display_types,name' ];

    public $ids;
    public $edit_name;

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
        $validatedData = $this->validate();

        $displayType = DisplayType::findOrFail($id);
            $displayType->name = $validatedData['edit_name'];
            $displayType->save();

        return redirect('/displays');
    }
}
