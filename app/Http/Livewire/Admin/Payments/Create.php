<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
use App\Models\Stage;
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
    public $wasl_number;
    public $daterange;
    public $payto;
    public $total_amount;
    public $redirect;
    protected $queryString = ['payment_type','account_type','account_id','amount_iqd','daterange','payto','redirect'];

    
    protected $rules = [

        'payment_type' => 'required',        'amount_usd' => 'required', 'amount_iqd' => 'required',       
              
        'account_type' => 'required',        


    ];

    public function initDirect()
    {
        $this->amount_iqd = Stage::find($this->redirect)->total_price;
    }

    public function mount()
    {
        $this->wasl_number=Payments::withTrashed()->where("payment_type",$this->payment_type)->max("wasl_number") + 1;
        if($this->daterange){
            $this->total_amount = $this->amount_iqd;
            
            $this->description = "اجور العمليات للفترة  : " . $this->daterange;
        }
        $this->route = url()->previous();
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    

    public function create($print=null)
    {

     

        $return_iqd =0;
        $return_usd =0;

        if($this->payment_type ==2){
        if($this->amount_iqd < 0){
            $return_iqd = $this->amount_iqd * -1;
            $this->amount_iqd=0;
        }

        if($this->amount_usd < 0){
            $return_usd = $this->amount_usd * -1;
            $this->amount_usd=0;
        }
    }

        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Payments') ])]);


        $data =[
        'payment_type' => $this->payment_type,
        'amount_usd' => $this->amount_usd,
        'amount_iqd' => $this->amount_iqd,
        'account_type' => $this->account_type,
        'description' => $this->description,
        'user_id' => auth()->id(),
        "wasl_number"=>$this->wasl_number,
        "redirect"=>$this->redirect,
        "return_iqd"=>$return_iqd,
        "return_usd"=>$return_usd,
    ];

  


        if($this->account_type == 1){
            $data['doctor_id'] = $this->account_id;
        }else if($this->account_type ==2){
            $data['patinet_id'] = $this->account_id;    
            $patdata = Patient::find($this->account_id);
            $patdata->paid =1;
           $patdata->save();
        }else if($this->account_type ==3){
            $data['account_name'] = $this->account_id;
        }

      $printid =   Payments::create($data);

     
      
        if($this->daterange){
            $data = OperationHold::query();
            $date1 = explode(" - ", $this->daterange)[0];
            $date2 = explode(" - ", $this->daterange)[1];
            $data = $data->whereBetween('created_at',[$date1 .' 00:00:00',$date2 .' 23:59:59']);
           
        if($this->payto =="doctor"){

            $data = $data->where("doctor_id",$this->account_id);
            $data->update([
                "doctor_paid"=>1
            ]);
        }elseif ($this->payto =="helper") {
            $data = $data->whereNull("helper_paid");
            $data->update([
                "helper_paid"=>1
            ]);
        }elseif ($this->payto =="helperm5dr") {
            $data = $data->whereNull("helperm5dr_paid");
            $data->update([
                "helperm5dr_paid"=>1
        ]);
        }elseif ($this->payto =="qabla") {
            $data = $data->whereNull("qabla_paid");
            $data->update([
                "qabla_paid"=>1
            ]);
        }elseif ($this->payto =="m5dr") {
            $data = $data->whereNull("m5dr_paid")->whereNotNull("m5dr_selected");
            $data->update([
                "m5dr_paid"=>1
            ]);
        }elseif ($this->payto =="mqema") {
            $data = $data->whereNull("mqema_paid");
            $data->update([
                "mqema_paid"=>1
            ]);
        }

    }


        if($this->return_id){
            $operation = OperationHold::where("payment_number",$this->return_id)->first();

            if($operation){
                $updateOpeartion = OperationHold::find($operation->id);
              
                $updateOpeartion->operation_price = $updateOpeartion->operation_price - $this->amount_iqd;
                $updateOpeartion->doctorexp = $updateOpeartion->nsba * $updateOpeartion->operation_price;
                $updateOpeartion->save();
            }
        }

       
        if($print){
          
        return  redirect(route("printrecept") . "?id=$printid->id");

           
        }

        return  redirect($this->route);

    }

    public function render()
    {
       
        
        return view('livewire.admin.payments.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Payments') ])]);
    }
}
