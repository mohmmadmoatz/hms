<?php

namespace App\Http\Livewire\Admin\Statement;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    protected $queryString = ['search','daterange'];

    public $doctor_id;
   
    public $datefilterON;
    public $daterange;

    public function searchBydate($date)
    {
        # code...
        $this->daterange = $date;
        $this->datefilterON = true;
    }

    public function render()
    {
        


        return view('livewire.admin.statement.home', [
        
        ])->layout('admin::layouts.app', ['title' => "الكشوفات" ]);
    }
}
