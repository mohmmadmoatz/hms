<?php

namespace App\Http\Livewire\Admin\Operationhold;

use App\Models\OperationHold;
use Livewire\Component;
use App\Models\Payments;
use App\Models\Setting;

class Single extends Component
{

    public $operationhold;

    public $optype;
    public $supervisedPrice;
    public function mount(OperationHold $operationhold){
        $this->operationhold = $operationhold;
    }

    public function savedoctor($price =null)
    {

        
        $supervised=0;
        $doctorexp = $this->operationhold->doctorexp;
        if($price){
          
            $doctorexp = explode(",",$price)[0];
            $supervised = explode(",",$price)[1];
            $this->operationhold->supervised =$supervised;
            $this->operationhold->doctorexp =$doctorexp;
            $this->operationhold->save();
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تحديد اجور الطبيب" ]);
         
        }else{
            $this->operationhold->doctor_paid =1;
            $this->operationhold->save();
        }
        

         $data =[
            'payment_type' => 1,
            'amount_iqd' => $doctorexp,
            'account_type' => 1,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            "doctor_id"=>$this->operationhold->doctor_id,
            "operation_price"=>$this->operationhold->operation_price,
            "patinet_id"=>$this->operationhold->patinet_id,
            "payment_number"=>$this->operationhold->payment_number,
            

        ];
        if(!$price){
            Payments::create($data);
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم انشاء سند صرف" ]);
        }else{
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تحديد اجور الطبيب" ]);
        }
  

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
            'amount_iqd' => Setting::find(1)->qabla,
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
        $this->operationhold->m5dr_selected =1;
        $this->operationhold->m5dr =$price;
        $this->operationhold->save();

        //  $data =[
        //     'payment_type' => 1,
        //     'amount_iqd' => $price,
        //     'description' => $this->operationhold->operation_name,
        //     'user_id' => auth()->id(),
        //     'account_type' => 3,
        //     "account_name"=>"مخدر",
        //     "operation_price"=>$this->operationhold->operation_price,
        //     "patinet_id"=>$this->operationhold->patinet_id,
        //     "payment_number"=>$this->operationhold->payment_number

        // ];

        // Payments::create($data);


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تحديد اجور المخدر" ]);

    }

    public function savemqema()
    {
        $this->operationhold->mqema_paid =1;
        $this->operationhold->mqema_price =1;
        $this->operationhold->save();

         $data =[
            'payment_type' => 1,
            'amount_iqd' => Setting::find(1)->mqema,
            'description' => $this->operationhold->operation_name,
            'user_id' => auth()->id(),
            'account_type' => 1,
            "doctor_id"=>Setting::find(1)->mqema_id,
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
