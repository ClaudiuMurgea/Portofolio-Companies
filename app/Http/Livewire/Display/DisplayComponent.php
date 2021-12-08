<?php

namespace App\Http\Livewire\Display;

use Livewire\Component;
use App\Models\DisplayType;

class DisplayComponent extends Component
{
    protected $listeners = ['show'];

    public $ids;
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;

    public function show ($type, $ids = null)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function render()
    {
        return view('livewire.display.display-component')->layout('layouts.admin.master');
    }
    
    public function destroy($id)
    {
        $displayType = DisplayType::findOrFail($id);
            $displayType->delete();
        
        return redirect('/displays');
    }
}
