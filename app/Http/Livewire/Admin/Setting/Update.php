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
        ]);
    }

    public function render()
    {
        return view('livewire.admin.setting.update', [
            'setting' => $this->setting
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Setting') ])]);
    }
}
