<?php

namespace App\Http\Livewire\Admin\Followup;

use App\Models\FollowUp;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $bp;
    public $pr;
    public $drain;
    public $itake;
    public $spo2;
    public $Temp;
    public $treatment;
    public $pat_id;
    public $date;
    public $output;
    
    protected $rules = [
        'pat_id' => 'required',        'date' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('FollowUp') ])]);
        
        FollowUp::create([
            'bp' => $this->bp,
            'pr' => $this->pr,
            'drain' => $this->drain,
            'itake' => $this->itake,
            'spo2' => $this->spo2,
            'Temp' => $this->Temp,
            'treatment' => $this->treatment,
            'pat_id' => $this->pat_id,
            'date' => $this->date,
            'output'=>$this->output,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.followup.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('FollowUp') ])]);
    }
}
