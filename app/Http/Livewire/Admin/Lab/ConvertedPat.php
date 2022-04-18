<?php

namespace App\Http\Livewire\Admin\Lab;

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
    
    public function render()
    {
        $data = Payments::query();

        if(config('easy_panel.crud.payments.search')){
            $array = (array) config('easy_panel.crud.payments.search');
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




        $data=  $data->latest()->where('redirect',2)->whereNull("redirect_done")
        ->with("Patient:name,id,lab")
        ->get();

        $filtered = $data->filter(function ($value, $key) {
            return $value->Patient->lab;
        });

        

        return view('livewire.admin.lab.convertedPat', [
            'data' => $filtered
        ])->layout('admin::layouts.app', ['title' => "محولين الى المختبر" ]);
    }
}