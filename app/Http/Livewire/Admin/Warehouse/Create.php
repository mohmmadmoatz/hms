<?php

namespace App\Http\Livewire\Admin\Warehouse;

use App\Models\Warehouse;
use App\Models\WarehouseItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $supplier_name;
    public $date;
    public $menu_no;
    public $phone;
    public $address;
    public $image;

    public $item;
    public $amount;
    public $qty;
    public $total;
    public $totalmenu;


    public $items = [];
    
    protected $rules = [
        'supplier_name' => 'required',        'date' => 'required',        'menu_no' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function addItem()
    {
       $this->items[]=  [
        "name"=>$this->item,
        "amount"=>$this->amount,
        "qty"=>$this->qty,
        "total"=>$this->total
       ];

       $this->item = "";
       $this->amount = 0;
       $this->qty = 1;
       $this->total = "";

    }

    public function deleteItem($index)
    {
        array_splice($this->items,$index);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Warehouse') ])]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/warehouse','public');
        }

       $menu =  Warehouse::create([
            'supplier_name' => $this->supplier_name,
            'date' => $this->date,
            'menu_no' => $this->menu_no,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image,
            'total' => $this->totalmenu,
            'user_id' => auth()->id(),
        ]);
     
        foreach ($this->items as $item) {
          
            $newitem = new WarehouseItem();
            $newitem->name = $item['name'];
            $newitem->qty = $item['qty'];
            $newitem->amount = $item['amount'];
            $newitem->total = $item['total'];
            $newitem->warehouses_id = $menu->id;
            $newitem->save();
        }

        $this->reset();
    }

    public function render()
    {
        $this->totalmenu = 0;
        $this->total = $this->qty *  $this->amount;
        foreach ($this->items as $item) {
           $this->totalmenu+= $item['total'];
        }
        return view('livewire.admin.warehouse.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Warehouse') ])]);
    }
}
