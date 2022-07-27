<?php

namespace App\Http\Livewire\Admin\Debittransaction;

use App\Models\DebitTransaction;
use App\Models\Payments;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Bank;
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
    public $imageOut;
    public $wasl_number;
    protected $queryString = ['payment_type','number'];

    
    protected $rules = [
        'date' => 'required',        'amount_iqd' => 'required',        'amount_usd' => 'required',        'name' => 'required',    
        'notes'=>'required'    
    ];

  

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function updatedNumber($value)
    {

        if($this->payment_type == 1){
            $debit = DebitTransaction::where('id',$value)->first();
            if($debit){
                $this->account_id = $debit->account_id;
                $this->amount_iqd = $debit->amount_iqd;
                $this->amount_usd = $debit->amount_usd;
                $this->imageOut = $debit->image;
               $this->dispatchBrowserEvent('refreshselect');   
            }else{
                $this->account_id = null;
                $this->amount_iqd = null;
                $this->amount_usd = null;
                $this->imageOut = null;
                $this->dispatchBrowserEvent('refreshselect');
            }
        }
    
    }

    public function mount()
    {
        
        $this->date = date('Y-m-d');

        $debit = DebitTransaction::where('id',$this->number)->first();
        if($debit){
            $this->account_id = $debit->account_id;
            $this->amount_iqd = $debit->amount_iqd;
            $this->amount_usd = $debit->amount_usd;
            $this->imageOut = $debit->image;  
        }
    }

    public function create()
    {
        $this->wasl_number=Payments::withTrashed()->where("payment_type",1)->max("wasl_number") + 1;
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
        

            $bank = Bank::create([
                'wasl_number' => $this->wasl_number,
                'description' => $this->notes,
                'amount_iqd' => $this->amount_iqd,
                'amount_usd' => $this->amount_usd,
                'date' => $this->date,
                'user_id' => auth()->id(),
                'wasl_number'=>$this->wasl_number
            ]);



       
        $debit->payment_id = $bank->id;
        $debit->save();

        if($this->number){
            DebitTransaction::where('id', $this->number)->update(['checked' => 1]);
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
