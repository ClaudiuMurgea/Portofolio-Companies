<?php

namespace App\Http\Livewire\Company\Settings;

use Livewire\Component;
use App\Models\Company;
use App\Models\DisplayType;
use App\Models\CompanySettings;
use App\Models\CompanyDisplay;

class SettingsComponent extends Component
{   
    public $company;
    public $display_types;
    public $facilities = 0;
    public $monitors = 0;
    public $displayTypes;
    public $display_type;
    public $oldSettings;

    public $return = false;
    public $active = true;
    
    public function back ()
    {
        $this->active = false;
        $this->return = true;
    }

    public function mount ($company)
    {
        $this->company = Company::findOrFail($company);
        if($this->company->settings()->exists())
        {
            $this->oldSettings = CompanySettings::where('company_id', $this->company->id)->first();
            $this->facilities = $this->oldSettings->max_facility;
            $this->monitors = $this->oldSettings->max_monitors;
        }

        $this->display_types = DisplayType::all();

        if( $this->company->displays() )
        {
            foreach($this->company->displays as $displayType)
            { 
                $this->displayTypes[] = $displayType->display_type; 
            }
        }
    }
    public function render ()
    {
        return view('livewire..company.settings.settings-component')->layout('layouts.admin.master');
    }
    
    public function save ()
    {
        $this->validate([
            'facilities'   => '',
            'monitors'     => '',
            'displayTypes' => ''
        ]);

        if( $this->company->settings()->exists() )
        {
            $settings = CompanySettings::where( 'company_id', $this->company->id )->first();
                $settings->max_facility = $this->facilities;
                $settings->max_monitors = $this->monitors;
                $settings->save();
        } 
        else 
        {
            $settings = new CompanySettings();
                $settings->company_id   = $this->company->id;
                $settings->max_facility = $this->facilities;
                $settings->max_monitors = $this->monitors;
                $settings->save();
        }

        $oldDisplays = CompanyDisplay::where( 'company_id', $this->company->id )->delete();

        foreach($this->displayTypes as $type)
        {
            $newDisplay = new CompanyDisplay();
                $newDisplay->company_id   = $this->company->id;
                $newDisplay->display_type = $type;
                $newDisplay->save();
        }

        $this->back();
    }
}
