<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
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
   
    
    protected $rules = [
        'payment_type' => 'required',        'amount_usd' => 'required', 'amount_iqd' => 'required',       'description' => 'required',        
    ];

    public function mount(Payments $payments){
        $this->payments = $payments;
        $this->payment_type = $this->payments->payment_type;
        $this->amount_usd = $this->payments->amount_usd;
        $this->amount_iqd = $this->payments->amount_iqd;
        $this->patinet_id = $this->payments->patinet_id;
        $this->description = $this->payments->description;
        $this->date = $this->payments->date;        
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
