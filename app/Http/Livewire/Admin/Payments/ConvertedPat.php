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

    public function saveSands($id,$setting)
    {
  

        $data =[
            'payment_type' => 2,
            'amount_iqd' => $setting['clinic_price'] + $setting['doctor_price'],
            'account_type' => 2,
            'description' => "اجور العيادة الأستشارية",
            'user_id' => auth()->id(),
            "patinet_id"=>$id
        ];

        Payments::create($data);

        $data =[
            'payment_type' => 1,
            'amount_iqd' => $setting['doctor_price'],
            'account_type' => 1,
            'description' => "اجور العيادة الأستشارية",
            'user_id' => auth()->id(),
            "doctor_id"=>$setting['doctor_id']
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