<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
use App\Models\Setting;
use App\Models\Patient;
use App\Models\OperationHold;


use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

use DB;
class ConvertedPat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $wasl_number;
    public $income;

    public $amount_iqd;
    public $amount_usd;
    public $description;
    public $patprofile;
    public $tabla;
    public $date;
    protected $queryString = ['search'];

    public function mount()
    {
        $this->date = Date("Y-m-d");
    }

    public function loadNumberRecept()
    {
      
        $this->wasl_number=Payments::withTrashed()->where("payment_type","2")->max("wasl_number") + 1;
    }

    public function changeCheck()
    {
        $setting = Setting::find(1);

        
    }

   

    public function saveOpSand($income,$doctorexp,$helper,$m5dr,$helperm5dr,$id,$print)
    {

        
        if(!$this->amount_iqd){
            $this->amount_iqd =0;
        }

        if(!$this->amount_usd){
            $this->amount_usd =0;
        }

        
        $return_iqd =0;
        $return_usd =0;

        if($this->amount_iqd < 0){
            $return_iqd = $this->amount_iqd * -1;
            $this->amount_iqd=0;
        }

        if($this->amount_usd < 0){
            $return_usd = $this->amount_usd * -1;
            $this->amount_usd=0;
        }
        
        $patient = Patient::find($id);
        
        $data =[
            'payment_type' => 2,
            "operation_price"=>$this->income,
            "operation_profile"=>$this->tabla,
            "operation_doctor"=>$patient->doctor_id,
            "operation_name"=>$patient->operation->name,
            "operation_nsba"=>$patient->hms_nsba,
            'amount_iqd' => $this->amount_iqd,
            'amount_usd' => $this->amount_usd,
            'return_iqd' => $return_iqd,
            'return_usd' => $return_usd,
            'account_type' => 2,
            'description' => $this->description,
            'user_id' => auth()->id(),
            "patinet_id"=>$id,
            "wasl_number"=>$this->wasl_number,
            "date"=>$this->date
        ];





        $number = Payments::create($data);

        $setting = Setting::find(1);
       
        $nurse_price =0;
        $ambulance=$setting->ambulance;

        if($patient->operation->name == "?????????? ????????????"){
        if($patient->hms_nsba >=60){
            if($this->income >= 600000){
                $doctorexp = ($this->income) * ($patient->hms_nsba / 100);
            }else{
                $doctorexp = 0;
            }
        }else{
            $doctorexp = 0;
        }
    }else{

        $opPrice = ($this->income);

        $doctorexp =($this->income) * ($patient->hms_nsba / 100);


    if($patient->hms_nsba  >= 60 && $patient->operation->name =="?????????? ????????????"){
        if($opPrice < $setting->min_op_price){
            $fixedNsba = $setting->min_op_price * ($setting->hnsba  / 100);
            $doctorexp = abs($opPrice - $fixedNsba);
        }
    }elseif ($opPrice < $patient->operation->price) {

        if($opPrice <= 200000){
            $doctorexp = $opPrice / 2;
        }else{
            $fixedNsba = $patient->operation->price * ($setting->hnsba  / 100);
            $doctorexp = abs($opPrice - $fixedNsba);
        }

        
        
    }

        $nurse_price=$setting->nurse_price;

    }

    if($patient->operation->name == "?????????? ????????????" || $patient->operation->name == "?????????? ????????????"){
        $ambulance=$setting->ambulance;
    }else{
        $ambulance=0;
    }

        $operation = [
            "patinet_id"=>$id,
            "doctor_id"=>$patient->doctor_id,
            "operation_price"=>$this->income,
            "operation_name"=>$patient->operation->name,
            "doctorexp"=>$doctorexp,
            "helper"=>$helper,
            "m5dr"=>$m5dr,
            "helperm5dr"=>$helperm5dr,
            "user_id"=>auth()->id(),
            "payment_number"=>$number->wasl_number,
            "nsba"=>$patient->hms_nsba,
            "mqema_id"=>$setting->mqema_id,
            "mqema_price"=>$setting->mqema,
            "qabla"=>$setting->qabla,
            "ambulance"=>$ambulance,
            "nurse_price"=>$nurse_price,
            "date"=>$this->date
           
        ];

        $operationid = OperationHold::create($operation);



        $updatepayments = Payments::find($number->id);

        $updatepayments->operation_id = $operationid->id;
        $updatepayments->save();


       
        $patdata = Patient::find($id);
        $patdata->paid =1;
        $patdata->save();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => "???? ?????????? ?????? ?????? ????????" ]);
        if($print){
            $this->dispatchBrowserEvent('open-window', ['url' => route("printrecept") . "?id=$number->id"]);
        }
    }

    public function saveSands($id,$income,$out,$string,$doctor)
    {
  

        $data =[
            'payment_type' => 2,
            'amount_iqd' => $income + $out,
            'account_type' => 2,
            'description' => $string,
            'user_id' => auth()->id(),
            "patinet_id"=>$id
        ];

        Payments::create($data);

        // $data =[
        //     'payment_type' => 1,
        //     'amount_iqd' => $out,
        //     'account_type' => 1,
        //     'description' => $string,
        //     'user_id' => auth()->id(),
        //     "doctor_id"=>$doctor
        // ];

        // Payments::create($data);

        $patdata = Patient::find($id);

        $patdata->paid =1;
        $patdata->save();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => "???? ?????????? ?????? ?????? ????????" ]);



    }

    public function render()
    {
        $data = Patient::query();

        if(config('easy_panel.crud.patient.search')){
            $array = (array) config('easy_panel.crud.patient.search');
            $data->where(function (Builder $query) use ($array){
                foreach ($array as $item) {
                    if(!is_array($item)) {
                        $query->orWhere($item, 'like', '%' . $this->search . '%');
                    } else {
                        $query->orWhereHas(array_key_first($item), function (Builder $query) use ($item) {
                            $query->where($item[array_key_first($item)], 'like', '%' . $this->search . '%');
                        });
                    }
                }
            });
        }
        $data=  $data->latest("updated_at")->where('paid',0)->paginate(20);

        return view('livewire.admin.payments.convertedPat', [
            'data' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Payments')) ]);
    }
}