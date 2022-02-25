<?php

namespace App\Http\Livewire\Admin\Warehouseitem;

use App\Models\Warehouseproduct;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $warehouseitem;

    public $name;
    public $amount;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function mount(Warehouseproduct $warehouseitem){
        $this->warehouseitem = $warehouseitem;
        $this->name = $this->warehouseitem->name;
        $this->amount = $this->warehouseitem->amount;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('WarehouseItem') ]) ]);
        
        $this->warehouseitem->update([
            'name' => $this->name,
            'amount' => $this->amount,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.warehouseitem.update', [
            'warehouseitem' => $this->warehouseitem
        ])->layout('admin::layouts.app', ['title' => "تعديل مادة" ]);
    }
}
