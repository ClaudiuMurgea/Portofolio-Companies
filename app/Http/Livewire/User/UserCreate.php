<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Region;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyAdmin;
use App\Models\Facility;
use App\Models\FacilityAdmin;
use App\Models\FacilityEditor;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permissions;
use Hash;

class UserCreate extends Component
{   
    public $name;
    public $email;
    public $password;
    public $role;
    public $region;
    public $roles;
    public $regions;

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

    public function mount ()
    {  
        $this->regions = Region::all();
        $this->roles = Role::all();

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

        return view('livewire.user.user-create')->layout('layouts.admin.master');
    }

    
    public function create ()
    {   
        $validatedData = $this->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'role'      => 'required',
            'region'    => '',
            'company'   => '',
            'facility'  => ''
        ]);
        
        $user = new User();
            $user->name     = $validatedData['name'];
            $user->email    = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

        if( $validatedData['region'] )
        {
            foreach($validatedData['region'] as $regionID)
            {
                $region = Region::find($regionID);
                $user->givePermissionTo($region->name);
            }
        } 

        if( $validatedData['company'] )
        {
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
                    $user->assignRole([ $role->name ]);
                }
            }
        
        return redirect('/users');
    }

}
