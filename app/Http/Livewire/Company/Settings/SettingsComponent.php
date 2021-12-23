<?php

namespace App\Http\Livewire\Company\Settings;

use Livewire\Component;
use App\Models\Company;
use App\Models\DisplayType;
use App\Models\CompanySettings;

class SettingsComponent extends Component
{   
    public $company;
    public $display_types;
    public $facilities;
    public $monitors;
    public $displayTypes = [];
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
    }
    public function render ()
    {
        return view('livewire..company.settings.settings-component')->layout('layouts.admin.master');
    }
    
    public function save ()
    {
        $this->validate([
            'facilities' => '',
            'monitors' => '',
            'displayTypes' => ''
        ]);

        if($this->company->settings()->exists())
        {
            $settings = CompanySettings::where('company_id', $this->company->id)->first();
                $settings->max_facility = $this->facilities;
                $settings->max_monitors = $this->monitors;
                $settings->save();
            $this->back();
        } 
        else 
        {
            $settings = new CompanySettings();
                $settings->company_id = $this->company->id;
                $settings->max_facility = $this->facilities;
                $settings->max_monitors = $this->monitors;
                $settings->save();
            $this->back();
        }
    }
}
