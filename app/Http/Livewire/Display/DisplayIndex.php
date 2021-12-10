<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayIndex extends Component
{   
    public $displayTypes;
    
    public $ids;
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function mount ()
    {
        $this->displayTypes = DisplayType::all();
    }

    public function render()
    {
        return view('livewire.display.display-index')->layout('layouts.admin.master');
    }

    public function destroy($id)
    {
        $displayType = DisplayType::findOrFail($id);
            $displayType->delete();
        
        return redirect('/displays');
    }
}
