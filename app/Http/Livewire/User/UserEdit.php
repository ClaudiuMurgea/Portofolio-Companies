<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Region;
use App\Models\Company;
use App\Models\CompanyAdmin;
use App\Models\Facility;
use App\Models\FacilityAdmin;
use App\Models\FacilityEditor;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permissions;
use Hash;

class UserEdit extends Component
{   
    public $ids;
    public $user;
    public $edit_name;
    public $edit_email;
    public $password;
    public $region;
    public $role;
    public $regions;
    public $roles;

    public $regionalCanMakeRoles;
    public $corporateCanMakeRoles;
    public $facilityCanMakeRoles;

    public $Regional_Admin  = false;
    public $Corporate_Admin = false;
    public $Facility_Admin  = false;
    public $Facility_Editor = false;

    public $company;
    public $companies;
    public $facility;
    public $facilities;

    public function Only ($type)
    {
        $this->Regional_Admin  = false;
        $this->Corporate_Admin = false;
        $this->Facility_Admin  = false;
        $this->Facility_Editor = false;

        $this->$type = true;
    }

    public function mount($userID)
    {
        $this->regions = Region::all();
        $this->roles = Role::all();
        $user = User::findOrFail($userID);
            $this->edit_name  = $user->name;
            $this->edit_email = $user->email;
            $this->ids        = $userID;  
            $this->user       = $user;
            $this->role       = $user->roles->first()->id;
            
            if(!$user->Region == null)
             {
                $this->region     = $user->Region->id;
             }     
                
            $this->regionalCanMakeRoles  = Role::where('id', 3)
                                        ->orWhere('id', 4)
                                        ->orWhere('id', 5)
                                        ->get();  

            $this->corporateCanMakeRoles = Role::where('id', 4)
                                        ->orWhere('id', 5)
                                        ->get();

            $this->facilityCanMakeRoles  = Role::where('id', 5)
                                        ->get();

            $this->companies  = Company::all();
            $this->facilities = Facility::all();
    }

    public function render()
    {   
        $roles = Role::all();
            $selectedRoles = $this->validate([ 'role' => '' ]);
            
        foreach($roles as $role)
        {
            if( $selectedRoles['role'] == $role->id )
            {   
                $roleName = str_replace(' ', '_', $role->name);
                $this->Only ($roleName);
            }
        }

        return view('livewire.user.user-edit')->layout('layouts.admin.master');
    }

    public function update ($id)
    {
        $validatedData = $this->validate([
            'edit_name'      => 'required',
            'edit_email'     => 'required|email|unique:users,email,' . $id,
            'password'       => '',
            'role'           => 'required|numeric|exists:roles,id',
            'region'         => '',
            'company'        => '',
            'facility'       => ''
        ]);

        $user = User::findOrFail($id);
        if(!$validatedData['password'] == null)
        {
            $user->password = Hash::make($validatedData['password']);
        }

            $user->name  =$validatedData['edit_name'];
            $user->email =$validatedData['edit_email'];
            $user->save();
    
        if( $validatedData['region'] )
        {
            foreach($validatedData['region'] as $regionID)
            {
                $region = Region::find($regionID);
                $user->syncPermissions($region->name);
            }
        } 

        if( $validatedData['company'] )
        {   
            $wasFacilityAdmin  = FacilityAdmin::where('user_id', $user->id)->delete();
            $wasFacilityEditor = FacilityEditor::where('user_id', $user->id)->delete();

            foreach($validatedData['company'] as $company)
            {   
                $companyAdmin = new CompanyAdmin ();
                $companyAdmin->user_id = $user->id;
                $companyAdmin->company_id = $company;
                $companyAdmin->save();
            }
        }
        
        if ( $validatedData['facility'] && ($this->Facility_Admin == true)) 
        {  
            $wasCompanyAdmin   = CompanyAdmin::where('user_id', $user->id)->delete();
            $wasFacilityEditor = FacilityEditor::where('user_id', $user->id)->delete();

            foreach($validatedData['facility'] as $facility)
            {
                $facilityAdmin = new FacilityAdmin ();
                $facilityAdmin->user_id = $user->id;
                $facilityAdmin->facility_id = $facility;
                $facilityAdmin->save();
            }
        } 
        elseif ( $validatedData['facility'] && ($this->Facility_Editor == true) )
        {
            $wasCompanyAdmin   = CompanyAdmin::where('user_id', $user->id)->delete();
            $wasFacilityAdmin  = FacilityAdmin::where('user_id', $user->id)->delete();

            foreach($validatedData['facility'] as $facility)
            {
                $facilityEditor = new FacilityEditor ();
                $facilityEditor->user_id = $user->id;
                $facilityEditor->facility_id = $facility;
                $facilityEditor->save();
            }
        }
        
        $roles = Role::all();
        foreach($roles as $role)
        {
            if($role->id == $validatedData['role'])
            {
                $user->removeRole($user->roles->first());
                $user->assignRole([ $role->name ]);
            }
        }
        return redirect('/users');
    }
}
