<?php

namespace App\Http\Livewire\Admin\Checkup;

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
        $data=  $data->where('status',1)->where("paid",1)->where("clcdoctor",0)->get();

        return view('livewire.admin.checkup.convertedPat', [
            'data' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Payments')) ]);
    }
}