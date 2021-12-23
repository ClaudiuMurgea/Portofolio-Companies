<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayIndex extends Component
{       
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

    public function render()
    {
        $displayTypes = DisplayType::all();
        return view('livewire.display.display-index', ['displayTypes' => $displayTypes])->layout('layouts.admin.master');
    }

    public function destroy($id)
    {
        $displayType = DisplayType::findOrFail($id);
            $displayType->delete();
    }
}
