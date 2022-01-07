<?php

namespace App\Http\Livewire\Admin\Operationhold;

use App\Models\OperationHold;
use Livewire\Component;
use App\Models\Payments;

class Single extends Component
{

    public $operationhold;

    public $optype;
    public function mount(OperationHold $operationhold){
        $this->operationhold = $operationhold;
    }

    public function savedoctor()
    {
        $this->operationhold->doctor_paid =1;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => $this->operationhold->doctorexp,
            'account_type' => 1,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            "doctor_id"=>$this->operationhold->doctor_id,
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number

        ];

        Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);

    }

    public function savehelper()
    {
        $this->operationhold->helper_paid =1;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => $this->operationhold->helper,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            'account_type' => 3,
            "account_name"=>"مساعد جراح",
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number

        ];

        Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);

    }


    public function savehelperm5dr()
    {
        $this->operationhold->helperm5dr_paid =1;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => $this->operationhold->helperm5dr,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            'account_type' => 3,
            "account_name"=>"مساعد مخدر",
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number

        ];

        Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);

    }

    public function saveqabla()
    {
        $this->operationhold->qabla_paid =1;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => "25000",
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            'account_type' => 3,
            "account_name"=>"القابلة",
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number

        ];

        Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);

    }
    

    public function savem5dr($price)
    {
        $this->operationhold->m5dr_paid =1;
        $this->operationhold->m5dr =$price;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => $price,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            'account_type' => 3,
            "account_name"=>"مخدر",
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number

        ];

        Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);

    }

    public function delete()
    {
        $this->operationhold->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('OperationHold') ]) ]);
        $this->emit('operationholdDeleted');
    }

    public function render()
    {
        return view('livewire.admin.operationhold.single')
            ->layout('admin::layouts.app');
    }
}
