<?php

namespace App\Http\Livewire\Admin\Debittransaction;

use App\Models\DebitTransaction;
use App\Models\Payments;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $number;
    public $date;
    public $amount_iqd;
    public $amount_usd;
    public $name;
    public $notes;
    public $payment_type = "1";
    public $file;
    public $account_id;
    
    protected $queryString = ['payment_type'];

    
    protected $rules = [
        'date' => 'required',        'amount_iqd' => 'required',        'amount_usd' => 'required',        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function mount()
    {
        
        $this->date = date('Y-m-d');
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('DebitTransaction') ])]);
        
        if($this->getPropertyValue('file') and is_object($this->file)) {
            $this->file = $this->getPropertyValue('file')->store('images/debit');
        }

        $debit =  DebitTransaction::create([
            'number' => $this->number,
            'date' => $this->date,
            'amount_iqd' => $this->amount_iqd,
            'amount_usd' => $this->amount_usd,
            'name' => $this->name,
            'notes' => $this->notes,
            'payment_type' => $this->payment_type,
            'file' => $this->file,
            'account_id' => $this->account_id,
            'user_id' => auth()->id(),
        ]);
        
        if($this->payment_type == 1) {
        

        $payment = Payments::create([
            'payment_type' => 1,
            'amount_usd' => $this->amount_usd,
            'amount_iqd' => $this->amount_iqd,
            'wasl_number' => $this->number,
            'account_type'=>3,
            'account_name'=>$this->name,
            'description' => $this->notes,
            'date' => $this->date,
            'user_id' => auth()->id(),

        ]);

        $debit->payment_id = $payment->id;
        $debit->save();

        if($this->number){
            DebitTransaction::where('number', $this->number)->update(['checked' => 1]);
        }

    }



        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.debittransaction.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('DebitTransaction') ])]);
    }
}
