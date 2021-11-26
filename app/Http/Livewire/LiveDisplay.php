<?php

namespace App\Http\Livewire;
use App\Models\DisplayType;

use Livewire\Component;

class LiveDisplay extends Component
{   
    public $selectData  = true;
    public $createData  = false;
    public $updateData  = false;
    public $readyToLoad = false;

    public $ids;
    public $name;
    public $edit_name;


    public function loadDisplay ()
    {
        $this->readyToLoad = true;
    }


    public function showForm ()
    {
        $this->selectData = false;
        $this->createData = true;
    }


    public function resetFields ()
    {
        $this->name = "";
    }


    public function render ()
    {   
        $displayTypes = DisplayType::all();
        return view('livewire.live-display', ['displayTypes' => $displayTypes])->layout('layouts.admin.master');
    }

    public function create ()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:display_types,name'
        ]);
        
        $displayType = new DisplayType();
        $displayType->name = $validatedData['name'];
        $displayType->save();

        $this->selectData = true;
        $this->createData = false;
    }

    public function edit ($id)
    {
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

        $displayType = DisplayType::find($id);
            $this->ids = $displayType->id;
            $this->edit_name = $displayType->name;
        
        $this->resetFields();
    }

    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name' => 'required|unique:display_types,name'
        ]);

        $displayType = DisplayType::findOrFail($id);
        $displayType->name = $validatedData['edit_name'];
        $displayType->save();

        $this->selectData = true;
        $this->updateData = false;
    }

    
    public function destroy($id)
    {
        $displayType = DisplayType::findOrFail($id);
        $displayType->delete();
    }
}
