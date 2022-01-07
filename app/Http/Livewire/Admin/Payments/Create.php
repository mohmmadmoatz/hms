<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Patient;
use App\Models\OperationHold;

class Create extends Component
{
    use WithFileUploads;

    public $payment_type =1;
    public $amount_usd = 0;
    public $amount_iqd =0;
    public $patinet_id;

    public $account_id;
    public $account_type;
    public $description;
    public $addnew = false;
    public $route;
    public $return_price;
    public $return_id;
    protected $queryString = ['patinet_id','addnew','payment_type'];

    
    protected $rules = [

        'payment_type' => 'required',        'amount_usd' => 'required', 'amount_iqd' => 'required',       
        'description' => 'required',        
        'account_type' => 'required',        


    ];

    public function mount()
    {
        if($this->addnew !=true){
            if($this->patinet_id){
                $pat=Patient::find($this->patinet_id);
                $this->account_id = $this->patinet_id;
                $this->account_type = 2;
                if($pat->status == 5){
                    $this->amount_iqd = $pat->operation->price;
                    $this->description = $pat->operation->name;
                }

                if($pat->status == 3){
                    $this->amount_iqd = Setting::first()->xray;
                    $this->description = "اجور الأشعة";
                    
                }

                if($pat->status == 4){
                    $this->amount_iqd = Setting::first()->sonar;
                    $this->description = "اجور السونار";
                }
              
                
            }

        }
        $this->route = url()->previous();
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Payments') ])]);


        $data =[
        'payment_type' => $this->payment_type,
        'amount_usd' => $this->amount_usd,
        'amount_iqd' => $this->amount_iqd,
        'account_type' => $this->account_type,
        'description' => $this->description,
        'user_id' => auth()->id()
    ];
    
        if($this->account_type == 1){
            $data['doctor_id'] = $this->account_id;
        }else if($this->account_type ==2){
            $data['patinet_id'] = $this->account_id;
        }else if($this->account_type ==3){
            $data['account_name'] = $this->account_id;
        }

        Payments::create($data);

        if($this->patinet_id){
            $pat = Patient::find($this->patinet_id);
            $pat->paid=1;
            
            if($pat->status == 3){
                $pat->xray = 0;

            }

            if($pat->status == 4){
                $pat->sonar = 0;
            }

            $pat->save();

        }

        if($this->return_id){
            $operation = OperationHold::where("payment_number",$this->return_id)->first();

            if($operation){
                $updateOpeartion = OperationHold::find($operation->id);
                $nsba = $updateOpeartion->doctorexp / $updateOpeartion->operation_price;
                $updateOpeartion->operation_price = $updateOpeartion->operation_price - $this->amount_iqd;
                $updateOpeartion->doctorexp = $nsba * $updateOpeartion->operation_price;
                $updateOpeartion->save();
            }
        }

        return  redirect($this->route);

    }

    public function render()
    {
       
        
        return view('livewire.admin.payments.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Payments') ])]);
    }
}
