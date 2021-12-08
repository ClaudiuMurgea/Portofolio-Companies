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
    public $facilitiesID;


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

        if( auth()->user()->hasRole('Facility Admin') )
        {
            $this->facilityAdminFacilities = FacilityAdmin::where('user_id', auth()->user()->id )->get();
                foreach($this->facilityAdminFacilities as $facility)
                {
                    $this->facilitiesID[] = $facility->facility_id;
                    
                }
        } 
        elseif( auth()->user()->hasRole('Corporate Admin') )
        {
            $this->adminFacilities = CompanyAdmin::where('user_id', auth()->user()->id )->first();
                $this->corporateAdminFacilities = Facility::where('company_id', $this->adminFacilities->company_id)->get();
                foreach($this->corporateAdminFacilities as $facility)
                {
                    $this->facilitiesID[] = $facility->id; 
                }
        }
        else 
        {
            $this->facilitiesID[] = 0;
        }
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

        if( $validatedData['region'] )                                              //add region to the regional admin
        {
            foreach($validatedData['region'] as $regionID)
            {
                $region = Region::find($regionID);
                $user->givePermissionTo($region->name);
            }
        }
        elseif ($this->Facility_Admin == true || $this->Facility_Editor == true)    //add region to facility users                  
        {
            foreach($validatedData['facility'] as $facilityID)
            {   
                $facility = Facility::find($facilityID);
                $user->givePermissionTo( $facility->Permissions->name );
            }
        }

        if( $validatedData['company'] )
        {
            $companyAdmin = new CompanyAdmin ();
                $companyAdmin->user_id = $user->id;
                $companyAdmin->company_id = $validatedData['company'];
                $companyAdmin->save();
        }
        
        if ( $validatedData['facility'] && ($this->Facility_Admin == true)) 
        {   
            foreach($validatedData['facility'] as $facility)
            {   
                $companyFacility = Facility::find($facility);
                    $companyID = $companyFacility->company_id;
                
                $facilityAdmin = new FacilityAdmin ();
                    $facilityAdmin->user_id     = $user->id;
                    $facilityAdmin->facility_id = $facility;
                    $facilityAdmin->save();

                $facilityUsers = new FacilityUser ();
                    $facilityUsers->user_id     = $user->id;
                    $facilityUsers->facility_id = $facility;
                    $facilityUsers->company_id  = $companyID;
                    $facilityUsers->save();
            }
        } 
        elseif ( $validatedData['facility'] && ($this->Facility_Editor == true) )
        {
            foreach($validatedData['facility'] as $facility)
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
