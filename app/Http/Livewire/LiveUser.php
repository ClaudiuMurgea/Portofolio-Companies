<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Region;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permissions;
use Hash;

class LiveUser extends Component
{   
    public $selectData = true;
    public $createData = false;
    public $updateData = false;

    public $ids;
    public $user;

    public $name;
    public $email;
    public $password;
    public $role;
    public $region;
   


    public $edit_name;
    public $edit_email;


    public function showForm ()
    {
        $this->selectData = false;
        $this->createData = true;
    }


    public function resetFields ()
    {
        $this->name       ="";
        $this->email      ="";
        $this->password   ="";
        $this->role       ="";
        $this->region     ="";
    }


    public function render ()
    {   
        $roles       = Role::all();
        $users       = User::all();
        $regions     = Region::all();

        $regionalCanMakeRoles  = Role::where('id', 2)
                                   ->orWhere('id', 4)
                                   ->orWhere('id', 5)
                                   ->get();  

        $corporateCanMakeRoles = Role::where('id', 4)
                                   ->orWhere('id', 5)
                                   ->get();

        $facilityCanMakeRoles  = Role::where('id', 5)
                                   ->get();

        return view('livewire.live-user', [
            'users'   => $users,
            'roles'   => $roles,
            'regions' => $regions,
            'regionalCanMakeRoles'  => $regionalCanMakeRoles,
            'corporateCanMakeRoles' => $corporateCanMakeRoles,
            'facilityCanMakeRoles'  => $facilityCanMakeRoles
            ])->layout('layouts.admin.master');
    }


    public function create ()
    {
        $validatedData = $this->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'region'    => 'required',
            'role'      => 'required'

        ]);
        
        $user = new User();
            $user->name     = $validatedData['name'];
            $user->email    = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

        if( $validatedData['region'] )
        {
            $region = Region::find($validatedData['region']);
            $user->givePermissionTo($region->name);
        }

            

        $roles = Role::all();
            foreach($roles as $role)
            {
                if($role->id == $validatedData['role'])
                {
                    $user->assignRole([ $role->name ]);
                }
            }
        
        $this->resetFields();
        $this->selectData = true;
        $this->createData = false;
    }


    public function edit ($id)
    {
        $this->selectData = false;
        $this->createData = false;
        $this->updateData = true;

        $user = User::findOrFail($id);
            $this->edit_name  = $user->name;
            $this->edit_email = $user->email;
            $this->ids        = $user->id;
    }

    
    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name'      => 'required',
            'edit_email'     => 'required|email|unique:users,email,' . $id,
            'password'       => 'required',
            'region'         => 'required',
            'role'           => 'required|numeric|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
            $user->name =$validatedData['edit_name'];
            $user->email =$validatedData['edit_email'];
            $user->password =Hash::make($validatedData['password']);
            $user->save();
        
        $region = Region::findOrFail($validatedData['region']);
            $user->syncPermissions();
            $user->givePermissionTo([$region->name]);
        
        $roles = Role::all();
        foreach($roles as $role)
        {
            if($role->id == $validatedData['role'])
            {
                $user->removeRole($user->roles->first());
                $user->assignRole([ $role->name ]);
            }
        }

        $this->selectData = true;
        $this->updateData = false;
    }

    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
