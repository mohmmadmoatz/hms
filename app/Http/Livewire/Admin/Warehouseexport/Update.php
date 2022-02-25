<?php

namespace App\Http\Livewire\Admin\Warehouseexport;

use App\Models\WarehouseExport;
use App\Models\Warehouseproduct;
use App\Models\WarehouseExportItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $warehouseexport;

    public $name;
    public $date;
    public $total;
    public $items=[];

    public $item;
    public $amount;
    public $qty;
    public $totalmenu;
    protected $rules = [
        'name' => 'required',        'date' => 'required',        
    ];

    public function addItem()
    {
      $product=Warehouseproduct::find($this->item);
       $this->items[]=  [
        "name"=>$this->item,
        "productname"=>$product->name,
        "product_id"=>$product->id,
        "amount"=>$this->amount,
        "qty"=>$this->qty,
        "total"=>$this->total
       ];

       
       $this->amount = 0;
       $this->qty = 1;
       $this->total = "";

    }

    public function mount(WarehouseExport $warehouseexport){
        $this->warehouseexport = $warehouseexport;
        $this->name = $this->warehouseexport->name;
        $this->date = $this->warehouseexport->date;
        $this->totalmenu = $this->warehouseexport->totalmenu;   
        $this->items =  WarehouseExportItem::where("export_id",$this->warehouseexport->id)->get();
        
        $this->items  = $this->items->toarray();   
        
        for ($i=0; $i < count($this->items); $i++) { 
            $this->items[$i]['productname'] = Warehouseproduct::find($this->items[$i]['product_id'])->name;
        }

    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('WarehouseExport') ]) ]);
        
        $this->warehouseexport->update([
            'name' => $this->name,
            'date' => $this->date,
            'total' => $this->totalmenu,
            'user_id' => auth()->id(),
        ]);

        WarehouseExportItem::where("export_id",$this->warehouseexport->id)->delete();

        foreach ($this->items as $item) {
           
            $newitem = new WarehouseExportItem();
            $newitem->product_id = $item['product_id'];
            $newitem->qty = $item['qty'];
            $newitem->amount = $item['amount'];
            $newitem->total = $item['total'];
            $newitem->export_id = $this->warehouseexport->id;
            $newitem->save();
        }

    }
    public function deleteItem($index)
    {
        array_splice($this->items,$index,1);

    }
    public function selectitem()
    {
        $product=Warehouseproduct::find($this->item);
        $this->amount = $product->amount;
        $this->qty = 1;
        $this->total = $product->amount;
    }

    public function render()
    {
        $this->totalmenu = 0;
        $this->total = $this->qty *  $this->amount;
        foreach ($this->items as $item) {
           $this->totalmenu+= $item['total'];
        }
        return view('livewire.admin.warehouseexport.update', [
            'warehouseexport' => $this->warehouseexport
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('WarehouseExport') ])]);
    }
}
