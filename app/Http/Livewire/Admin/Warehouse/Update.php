<?php

namespace App\Http\Livewire\Admin\Warehouse;

use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\WarehouseItem;


class Update extends Component
{
    use WithFileUploads;

    public $warehouse;

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

    public function mount(Warehouse $warehouse){
        $this->warehouse = $warehouse;
        $this->supplier_name = $this->warehouse->supplier_name;
        $this->date = $this->warehouse->date;
        $this->menu_no = $this->warehouse->menu_no;
        $this->phone = $this->warehouse->phone;
        $this->address = $this->warehouse->address;
        $this->image = $this->warehouse->image;   
        $this->items =  WarehouseItem::where("warehouses_id",$this->warehouse->id)->get();
        $this->items  = $this->items->toarray(); 
        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Warehouse') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/warehouse');
        }

        $this->warehouse->update([
            'supplier_name' => $this->supplier_name,
            'date' => $this->date,
            'menu_no' => $this->menu_no,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image,
            'user_id' => auth()->id(),
        ]);

        WarehouseItem::where("warehouses_id",$this->warehouse->id)->delete();

        foreach ($this->items as $item) {
          
            $newitem = new WarehouseItem();
            $newitem->name = $item['name'];
            $newitem->qty = $item['qty'];
            $newitem->amount = $item['amount'];
            $newitem->total = $item['total'];
            $newitem->warehouses_id = $this->warehouse->id;
            $newitem->save();
        }



    }

    public function render()
    {
        $this->totalmenu = 0;
        $this->total = $this->qty *  $this->amount;
        foreach ($this->items as $item) {
           $this->totalmenu+= $item['total'];
        }

        return view('livewire.admin.warehouse.update', [
            'warehouse' => $this->warehouse
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Warehouse') ])]);
    }
}
