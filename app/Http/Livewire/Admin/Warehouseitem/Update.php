<?php

namespace App\Http\Livewire\Admin\Warehouseitem;

use App\Models\WarehouseItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $warehouseitem;

    public $name;
    public $qty;
    
    protected $rules = [
        'name' => 'required',        'qty' => 'required',        
    ];

    public function mount(WarehouseItem $warehouseitem){
        $this->warehouseitem = $warehouseitem;
        $this->name = $this->warehouseitem->name;
        $this->qty = $this->warehouseitem->qty;        
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
            'qty' => $this->qty,            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.warehouseitem.update', [
            'warehouseitem' => $this->warehouseitem
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('WarehouseItem') ])]);
    }
}
