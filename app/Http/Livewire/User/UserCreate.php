<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Region;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyAdmin;
use App\Models\Facility;
use App\Models\FacilityUser;
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

    public $Platform_Admin  = false;
    public $Regional_Admin  = false;
    public $Corporate_Admin = false;
    public $Facility_Admin  = false;
    public $Facility_Editor = false;

    public $company;
    public $companies;
    public $facility;
    public $facilities;

    public $facilityAdminFacilities;
    public $corporateAdminFacilities;
    public $userID;
    public $facilitiesID;
    public $companyID;

    public $companyFacilities;
    public $facilityCompany;

    public $return = false;
    public $active = true;

    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function Only ($type)
    {   
        $this->Platform_Admin  = false;
        $this->Regional_Admin  = false;
        $this->Corporate_Admin = false;
        $this->Facility_Admin  = false;
        $this->Facility_Editor = false;

        $this->$type = true;
    }

    public function mount ()
    {  
        $this->roles      = Role::all();
        $this->regions    = Region::all();
        $this->companies  = Company::all();
        $this->facilities = Facility::all();

        $this->regionalCanMakeRoles  = Role::where('name', 'Corporate Admin')
                                         ->orWhere('name', 'Facility Admin' )
                                         ->orWhere('name', 'Facility Editor')
                                         ->get();  

        $this->corporateCanMakeRoles = Role::where('name', 'Facility Admin' )
                                         ->orWhere('name', 'Facility Editor')
                                         ->get();

        $this->facilityCanMakeRoles  = Role::where('name', 'Facility Editor')
                                         ->get();

        $this->userID = auth()->user()->id;

        if( auth()->user()->hasRole('Corporate Admin') )
        {
            $this->corporateAdminFacilities = CompanyAdmin::where( 'user_id', $this->userID )->get();

            foreach($this->corporateAdminFacilities as $companyAdmin)
            {
                $this->facilitiesID[] = $companyAdmin->company_id;
            }

        }
        elseif( auth()->user()->hasRole('Facility Admin') )
        {
            $this->facilityAdminFacilities = auth()->user()->facilityUsers;

            foreach($this->facilityAdminFacilities as $facilityAdmin)
            {   
                $this->facilitiesID[] = $facilityAdmin->facility_id;
            }
            
        }
        else 
        {
            $facilitiesID = [];
        }
    }

    public function render()
    {   
        foreach($this->roles as $DBrole)
        {
            if( $this->role == $DBrole->name )
            {   
                $roleName = str_replace(' ', '_', $DBrole->name);
                $this->Only ($roleName);
            }
        }

        return view('livewire.user.user-create')->layout('layouts.admin.master');
    }

    public function create ()
    {  
        $this->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'role'      => 'required',
            'region'    => 'required_if:role,Regional Admin',
            'company'   => 'required_if:role,Corporate Admin',
            'facility'  => 'required_if:role,Facility Admin,Facility Editor'
        ]);

        $user = new User();
            $user->name     = $this->name;
            $user->email    = $this->email;
            $user->password = Hash::make($this->password);
            $user->save();
            $role = Role::where('name', $this->role)->first();
            $user->assignRole($role->name);

        if( $this->region )                                                         //add region to the regional admin
        {
            foreach($this->region as $regionID)
            {
                $region = Region::find($regionID);
                $user->givePermissionTo($region->name);
            }
        }
        elseif ($this->Facility_Admin == true || $this->Facility_Editor == true)    //add region to facility users                  
        {   
            if($this->facility == true) 
            {
                foreach( $this->facility as $facilityID)
                {   
                    $facility = Facility::find($facilityID);
                    $user->givePermissionTo( $facility->Permissions->name );
                }
            }
        }

        if( $this->company )
        {
            $companyAdmin = new CompanyAdmin ();
                $companyAdmin->user_id = $user->id;
                $companyAdmin->company_id = $this->company;
                $companyAdmin->save();
        }
        
        if ( $this->facility && ($this->Facility_Admin == true)) 
        {   
            foreach( $this->facility as $oneID)
            {   
                $companyFacility = Facility::find($oneID);
                    $companyID = $companyFacility->company_id;
                
                $facilityAdmin = new FacilityAdmin ();
                    $facilityAdmin->user_id     = $user->id;
                    $facilityAdmin->facility_id = $oneID;
                    $facilityAdmin->save();

                $facilityUsers = new FacilityUser ();
                    $facilityUsers->user_id     = $user->id;
                    $facilityUsers->facility_id = $oneID;
                    $facilityUsers->company_id  = $companyID;
                    $facilityUsers->save();
            }
        } 
        elseif ( $this->facility && ($this->Facility_Editor == true) )
        {
            foreach( $this->facility as $facility )
            {
                $companyFacility = Facility::find($facility);
                    $companyID = $companyFacility->company_id;

                $facilityEditor = new FacilityEditor ();
                    $facilityEditor->user_id = $user->id;
                    $facilityEditor->facility_id = $facility;
                    $facilityEditor->save();

                $facilityUsers = new FacilityUser ();
                    $facilityUsers->user_id     = $user->id;
                    $facilityUsers->facility_id = $facility;
                    $facilityUsers->company_id  = $companyID;
                    $facilityUsers->save();
            }
        }

        $this->back();
    }
}
