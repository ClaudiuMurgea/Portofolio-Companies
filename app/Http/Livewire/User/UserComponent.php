<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

class UserComponent extends Component
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
        return view('livewire.user.user-component')->layout('layouts.admin.master');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user');
    }
}
