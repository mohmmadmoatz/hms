<?php

namespace App\Http\Livewire\Admin\Followup;

use App\Models\FollowUp;
use App\Models\Patient;
use App\Models\Room;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search','patient_id'];

    protected $listeners = ['followupDeleted'];

    public $sortType;
    public $sortColumn;

    public $patient_id;

    public function followupDeleted(){
        // Nothing ..
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';

        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $data = FollowUp::query();
        $pats = Room::latest();
        
        if(config('easy_panel.crud.followup.search')){
            $array = (array) config('easy_panel.crud.followup.search');
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

        if($this->patient_id){
            $data = $data->where("pat_id",$this->patient_id);
        }else{
            $data = $data->where("id","0");
        }


        if($this->sortColumn) {
            $data->orderBy($this->sortColumn, $this->sortType);
        } else {
            $data->latest('id');
        }

        $pats = $pats
        ->where("patient_id","!=",0)
        ->with("user")->get();
        //dd($pats);
        
        $data = $data->paginate(config('easy_panel.pagination_count', 15));

        return view('livewire.admin.followup.read', [
            'followups' => $data,
            'pats' => $pats
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('FollowUp')) ]);
    }
}
