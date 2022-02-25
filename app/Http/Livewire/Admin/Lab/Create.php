<?php

namespace App\Http\Livewire\Admin\Lab;

use App\Models\Lab;
use App\Models\Payments;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $patient_id;
    public $notes;
    public $image;
    public $payment_id;
    protected $queryString = ['patient_id','payment_id'];
    
    protected $rules = [
        'patient_id' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Lab') ])]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/labs');
        }

        $labdata = Lab::create([
            'patient_id' => $this->patient_id,
            'notes' => $this->notes,
            'image' => $this->image,            
        ]);

       

        $pat = Payments::find($this->payment_id);
        $pat->redirect_done = $labdata->id;
        $pat->save();

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.lab.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Lab') ])]);
    }
}
