<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payments;
use App\Models\Patient;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class ConvertedPat extends Component
{
    public $search;

    protected $queryString = ['search'];

    public function saveOpSand($income,$doctorexp,$helper,$m5dr,$helperm5dr,$id)
    {
        $patient = Patient::find($id);
    
        $data =[
            'payment_type' => 2,
            'amount_iqd' => $income,
            'account_type' => 2,
            'description' => $patient->operation->name,
            'user_id' => auth()->id(),
            "patinet_id"=>$id
        ];


        $idnumber = $data->id;


        Payments::create($data);


        $data =[
            'payment_type' => 1,
            'amount_iqd' => $doctorexp,
            'account_type' => 1,
            'description' => $patient->operation->name,
            'user_id' => auth()->id(),
            "doctor_id"=>$patient->doctor_id,
            "operation_price"=>$patient->operation->price,
            "patinet_id"=>$id,
            "payment_number"=>$idnumber

        ];

        

        Payments::create($data);
        

        $data =[
            'payment_type' => 1,
            'amount_iqd' => $helper,
            'account_type' => 3,
            'description' => $patient->operation->name,
            'user_id' => auth()->id(),
            "account_name"=>"مساعد جراح",
            "patinet_id"=>$id,
            "payment_number"=>$idnumber

        ];

        

        Payments::create($data);



        $data =[
            'payment_type' => 1,
            'amount_iqd' => $m5dr,
            'account_type' => 3,
            'description' => $patient->operation->name,
            'user_id' => auth()->id(),
            "account_name"=>"طبيب مخدر",
            "patinet_id"=>$id,
            "payment_number"=>$idnumber

        ];

        

        Payments::create($data);


        $data =[
            'payment_type' => 1,
            'amount_iqd' => $helperm5dr,
            'account_type' => 3,
            'description' => $patient->operation->name,
            'user_id' => auth()->id(),
            "account_name"=>"مساعد مخدر",
            "patinet_id"=>$id,
            "payment_number"=>$idnumber

        ];

        

        Payments::create($data);

        $patdata = Patient::find($id);

        $patdata->paid =1;
        $patdata->save();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => "تم انشاء سند صرف وقبض" ]);
        
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

        $data =[
            'payment_type' => 1,
            'amount_iqd' => $out,
            'account_type' => 1,
            'description' => $string,
            'user_id' => auth()->id(),
            "doctor_id"=>$doctor
        ];

        Payments::create($data);

        $patdata = Patient::find($id);

        $patdata->paid =1;
        $patdata->save();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => "تم انشاء سند صرف وقبض" ]);



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
        $data=  $data->where('paid',0)->get();
        return view('livewire.admin.payments.convertedPat', [
            'data' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Payments')) ]);
    }
}