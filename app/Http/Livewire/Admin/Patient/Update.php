<?php

namespace App\Http\Livewire\Admin\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $patient;

    public $name;
    public $gender;
    public $phone;
    public $patientid;
    public $floor;

    public $status;
    public $image;
    public $clinic_id;
    public $age;
    public $room_id;
    public $doctor_id;
    public $opration_id;
    public $inter_at;
    public $identity_circule;
    public $identity_page;
    public $identity_book;
    public $relaitve_name;
    public $relaitve_phone;
    public $job;
    public $mother;
    public $Nationality;
    public $adress;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function mount(Patient $patient){
        $this->patient = $patient;
        $this->name = $this->patient->name;
        $this->age = $this->patient->age;
        $this->gender = $this->patient->gender;
        $this->phone = $this->patient->phone;
        $this->status = $this->patient->status;
        $this->image = $this->patient->image;        
        $this->clinic_id = $this->patient->clinic_id;
        $this->room_id = $this->patient->room_id;
        $this->doctor_id = $this->patient->doctor_id;
        $this->opration_id = $this->patient->opration_id;
        $this->inter_at = $this->patient->inter_at;
        $this->identity_circule = $this->patient->identity_circule;
        $this->identity_page = $this->patient->identity_page;
        $this->identity_book = $this->patient->identity_book;
        $this->relaitve_name = $this->patient->relaitve_name;
        $this->relaitve_phone = $this->patient->relaitve_phone;
        $this->job = $this->patient->job;
        $this->mother = $this->patient->mother;
        $this->Nationality = $this->patient->Nationality;
        $this->adress = $this->patient->adress;

    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Patient') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/patients','public');
        }
        $updatedata =[
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'status' => $this->status,
            'image' => $this->image,            
            'age' => $this->age,            
            'clinic_id' => $this->clinic_id,
            'room_id' =>$this->room_id,
            'doctor_id'=>$this->doctor_id,
            'opration_id'=>$this->opration_id,       
            'inter_at'=>$this->inter_at,
            'identity_circule'=>$this->identity_circule,
            'identity_page'=>$this->identity_page,
            'identity_book'=>$this->identity_book,
            'relaitve_name'=>$this->relaitve_name,
            'relaitve_phone'=>$this->relaitve_phone,
            'job'=>$this->job,
            'mother'=>$this->mother,
            'Nationality'=>$this->Nationality,
            'adress'=>            $this->adress,

                          
        ];
      

        $this->patient->update($updatedata);
    }

    public function render()
    {
        return view('livewire.admin.patient.update', [
            'patient' => $this->patient
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Patient') ])]);
    }
}
