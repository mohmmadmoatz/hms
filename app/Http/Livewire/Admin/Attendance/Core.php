<?php

namespace App\Http\Livewire\Admin\Attendance;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Core extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $status;
    protected $queryString = ['search'];

   

    public $sortType;
    public $sortColumn;

    

   
    public function render()
    {
        $data = Attendance::query();
        $data= $data->paginate(10);
        return view('livewire.admin.attendance.logs', [
            'data' => $data
        ])->layout('admin::layouts.app', ['title' => __(\Str::plural('Patient')) ]);
    }
}
