<?php

namespace App\Http\Livewire\Admin\Warehouseexport;

use App\Models\WarehouseExport;
use App\Models\WarehouseItem;
use App\Models\WarehouseExportItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $date;
    public $total;
    public $items=[];

    public $item;
    public $amount;
    public $qty;
    public $qtynow;
    public $totalmenu;

    protected $rules = [
        'name' => 'required',        'date' => 'required',        
    ];

    public function addItem()
    {
      $product=WarehouseItem::find($this->item);
       $this->items[]=  [
        "name"=>$this->item,
        "productname"=>$product->name,
        "amount"=>$this->amount,
        "qty"=>$this->qty,
        "total"=>$this->total
       ];

       
       $this->amount = 0;
       $this->qty = 1;
       $this->total = "";

    }

    public function deleteItem($index)
    {
        array_splice($this->items,$index);
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('WarehouseExport') ])]);
        
       $menu = WarehouseExport::create([
            'name' => $this->name,
            'date' => $this->date,
            'total' => $this->totalmenu,
            'user_id' => auth()->id(),
        ]);

        foreach ($this->items as $item) {
          
            $newitem = new WarehouseExportItem();
            $newitem->product_id = $item['name'];
            $newitem->qty = $item['qty'];
            $newitem->amount = $item['amount'];
            $newitem->total = $item['total'];
            $newitem->export_id = $menu->id;
            $newitem->save();
        }

        $this->reset();
    }

    public function selectitem()
    {
        $product=WarehouseItem::find($this->item);
        $this->amount = $product->amount;
        $this->qty = 1;
        $this->qtynow = $product->qtynow;
        $this->total = $product->amount;
    }

    public function render()
    {
        
        $this->totalmenu = 0;
        $this->total = $this->qty *  $this->amount;
        foreach ($this->items as $item) {
           $this->totalmenu+= $item['total'];
        }

        return view('livewire.admin.warehouseexport.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('WarehouseExport') ])]);
    }
}
