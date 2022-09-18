<?php

namespace App\Http\Livewire\Admin\Lab;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Labpat extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $status;
    protected $queryString = ['search'];

    protected $listeners = ['patientDeleted'];

    public $sortType;
    public $sortColumn;

    public function patientDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function hide($id)
    {
        $pat = Patient::find($id);
        $pat->labhide = 1;
        $pat->save();
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

        $data->
        where(function (Builder $query) {
          
            $query->where('status',2)
            ->orWhere('status',8);
        
    })
        ->where("paid",0)->whereNull("labhide");

        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }
       
          
        
        $data = $data->paginate(config('easy_panel.pagination_count', 15));

        return view('livewire.admin.lab.labpat', [
            'patients' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Patient')) ]);
    }
}
