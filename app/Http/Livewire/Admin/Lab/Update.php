<?php

namespace App\Http\Livewire\Admin\Lab;

use App\Models\Lab;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $lab;

    public $patient_id;
    public $notes;
    public $image;
    
    protected $rules = [
        'patient_id' => 'required',        
    ];

    public function mount(Lab $lab){
        $this->lab = $lab;
        $this->patient_id = $this->lab->patient_id;
        $this->notes = $this->lab->notes;
        $this->image = $this->lab->image;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Lab') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/labs');
        }

        $this->lab->update([
            'patient_id' => $this->patient_id,
            'notes' => $this->notes,
            'image' => $this->image,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.lab.update', [
            'lab' => $this->lab
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Lab') ])]);
    }
}
