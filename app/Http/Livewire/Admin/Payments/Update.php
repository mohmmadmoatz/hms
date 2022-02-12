<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
use App\Models\User;
use App\Models\Stage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $payments;

    public $payment_type;
    public $amount_usd;
    public $amount_iqd;
    public $patinet_id;
    public $description;
    public $account_type;
    public $redirect;
    public $redirect_doctor_price;
    public $redirect_nurse_price;
    public $redirect_doctor_id;
   
    
    protected $rules = [
        'payment_type' => 'required',        'amount_usd' => 'required', 'amount_iqd' => 'required',        
    ];

    public function initDirect()
    {
        if($this->redirect){

        
        $this->amount_iqd = Stage::find($this->redirect)->total_price;
        if($this->redirect_doctor_id){
            $doctor_id=$this->redirect_doctor_id;
        }else{
        $doctor_id = Stage::find($this->redirect)->doctor_id;

        }
        $doctor = User::find($doctor_id);

        $this->redirect_doctor_id = $doctor_id;
        $this->redirect_doctor_price = Stage::find($this->redirect)->doctor_price;

        if($doctor){    
        if($doctor->user_type == "doctor"){
            $this->redirect_doctor_price = Stage::find($this->redirect)->doctor_price;

        }else{
            $this->redirect_doctor_price = Stage::find($this->redirect)->res_price;
        }
    }

        $this->redirect_nurse_price = Stage::find($this->redirect)->other_price;

    }
    }

    public function changeDoctor()
    {
        $doctor = User::find($this->redirect_doctor_id);
        
        
        if($doctor){    
            if($doctor->user_type == "doctor" || $doctor->user_type =="rays"){
                $this->redirect_doctor_price = Stage::find($this->redirect)->doctor_price;
    
            }else{
                $this->redirect_doctor_price = Stage::find($this->redirect)->res_price;
            }
        }
        
    }

    public function mount(Payments $payments){
        $this->payments = $payments;
        $this->payment_type = $this->payments->payment_type;
        $this->amount_usd = $this->payments->amount_usd;
        $this->amount_iqd = $this->payments->amount_iqd;
        $this->patinet_id = $this->payments->patinet_id;
        $this->description = $this->payments->description;
        $this->account_type = $this->payments->account_type;
        $this->date = $this->payments->date;      
        $this->redirect = $this->payments->redirect; 

        $this->redirect_doctor_price = $this->payments->redirect_doctor_price;  
        $this->redirect_nurse_price = $this->payments->redirect_nurse_price;  
        $this->redirect_doctor_id = $this->payments->redirect_doctor_id;  

    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Payments') ]) ]);
        
        $this->payments->update([
            'payment_type' => $this->payment_type,
            'amount_usd' => $this->amount_usd,
            'amount_iqd' => $this->amount_iqd,
            'description' => $this->description,
        "redirect"=>$this->redirect,
        'redirect_doctor_price' => $this->redirect_doctor_price,
        'redirect_doctor_id' => $this->redirect_doctor_id,
        'redirect_nurse_price' => $this->redirect_nurse_price,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.payments.update', [
            'payments' => $this->payments
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Payments') ])]);
    }
}
