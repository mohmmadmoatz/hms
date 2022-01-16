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
    public $doctorexp;
    public $helperprice;
    public $helperm5dr;
    public $qabla;
    public $mqema_price;
    public $nurse_price;
    public $ambulance;
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
            $this->operationhold->doctorexp =$this->doctorexp;
            $this->operationhold->save();
        }
        
        if(!$price){
        
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تعديل السعر" ]);
        }else{
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تحديد اجور الطبيب" ]);
        }
  
        $this->emit('operationholdDeleted');

   

 
   }

   public function saveAmb()
   {
       $this->operationhold->ambulance =$this->ambulance;
       $this->operationhold->save();
       $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تعديل السعر" ]);

   }

   public function savenurse()
   {
       $this->operationhold->nurse_price =$this->nurse_price;
       $this->operationhold->save();
       $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تعديل السعر" ]);

   }

    public function savehelper()
    {
        $this->operationhold->helper =$this->helperprice;
        $this->operationhold->save();

         


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تعديل السعر" ]);

    }


    public function savehelperm5dr()
    {
        $this->operationhold->helperm5dr =$this->helperm5dr;
        $this->operationhold->save();

        


        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => "تم تعديل السعر" ]);

    }

    public function saveqabla()
    {
        $this->operationhold->qabla =$this->qabla;
        $this->operationhold->save();

       


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
      
        $this->operationhold->mqema_price =$this->mqema_price;
        $this->operationhold->save();

        


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
