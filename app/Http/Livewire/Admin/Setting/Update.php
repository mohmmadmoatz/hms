<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $setting;

    public $xray;
    public $xray_doctor_price;
    public $xray_doctor_id;

    public $sonar;
    public $doctor_sonar_price;
    public $doctor_sonar_id;
    public $clinic_price;
    public $doctor_price;
    public $doctor_id;

    public $pat_profile;
    public $helper_doctor;
    public $m5dr_doctor;
    public $m5dr_large_doctor;
    public $m5dr_small_doctor;
    

    public $helper_m5dr_doctor;
    
    protected $rules = [
        'xray' => 'required',        
    ];

    public function mount(Setting $setting){
        $this->setting = $setting;
        $this->xray = $this->setting->xray;
        $this->sonar = $this->setting->sonar;
        $this->clinic_price = $this->setting->clinic_price;
        $this->doctor_price = $this->setting->doctor_price;
        $this->doctor_id = $this->setting->doctor_id; 

        $this->pat_profile = $this->setting->pat_profile; 
        $this->helper_doctor = $this->setting->helper_doctor; 
        $this->m5dr_doctor = $this->setting->m5dr_doctor; 

        $this->m5dr_large_doctor = $this->setting->m5dr_large_doctor; 
        $this->m5dr_small_doctor = $this->setting->m5dr_small_doctor; 

        $this->helper_m5dr_doctor = $this->setting->helper_m5dr_doctor; 
        $this->xray_doctor_price = $this->setting->xray_doctor_price;        
        $this->xray_doctor_id = $this->setting->xray_doctor_id;        
        $this->doctor_sonar_price = $this->setting->doctor_sonar_price;        
        $this->doctor_sonar_id = $this->setting->doctor_sonar_id;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Setting') ]) ]);
        
        $this->setting->update([
            'xray' => $this->xray,            'sonar' => $this->sonar,            'clinic_price' => $this->clinic_price,            'doctor_price' => $this->doctor_price,            'doctor_id' => $this->doctor_id,  
            'xray_doctor_price' => $this->xray_doctor_price,         
            'xray_doctor_id' => $this->xray_doctor_id,         
            'doctor_sonar_price' => $this->doctor_sonar_price,         
            'doctor_sonar_id' => $this->doctor_sonar_id,  

            'pat_profile' => $this->pat_profile,         
            'helper_doctor' => $this->helper_doctor,         
            'm5dr_doctor' => $this->m5dr_doctor,

            'm5dr_large_doctor' => $this->m5dr_large_doctor,         
            'm5dr_small_doctor' => $this->m5dr_small_doctor,         
            'helper_m5dr_doctor' => $this->helper_m5dr_doctor,         
        ]);
    }

    public function render()
    {
        return view('livewire.admin.setting.update', [
            'setting' => $this->setting
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Setting') ])]);
    }
}
