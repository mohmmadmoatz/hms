<?php

namespace App\Http\Livewire\Admin\Lab;

use App\Models\Patient;
use App\Models\LabSetting;
use App\Models\Room;
use App\Models\MedicineProfile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Labpatedit extends Component
{
    use WithFileUploads;
    public $patient;
    public $name;
    public $gender = "انثى";
    public $phone;
    public $patientid;
    public $status;
    public $age;
    public $image;

    public $item;
    public $items = [];
    public $amount;
    public $totalamount=0;
    protected $rules = [
        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function mount(Patient $patient){
        $this->patient = $patient;
        $this->name = $this->patient->name;
        $this->age = $this->patient->age;
        $this->phone = $this->patient->phone;
        $this->gender = $this->patient->gender;
      
    
    }

    public function selectitem()
    {
        if($this->item){
            $item=LabSetting::find($this->item);
            $this->amount = $item->amount;
        }
       
    }

   

    public function deleteitem($index)
    {
        array_splice($this->items,$index,1);

    }

    public function addItem()
    {
        $product=LabSetting::find($this->item);
        $this->items[]=  [
         "id"=>$this->item,
         "name"=>$product->name,
         "amount"=>$this->amount,
        ];
        $this->amount = 0;
        $this->qty = 1;
        $this->total = "";

    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Patient') ])]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/patients','public');
        }
        
        $this->patient->update([
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'status' => 2,
            'image' => $this->image,            
            'age' => $this->age,     
            'lab'=>json_encode($this->items),
            "total_lab"=>$this->totalamount,
            'paid'=>0
                       
        ]);

       


   



    }

    public function render()
    {
       $total=0;
        foreach ($this->items as $item) {
           $total = $total + $item['amount'];
        }
        $this->totalamount = $total;
        return view('livewire.admin.lab.editpat')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Patient') ])]);
    }
}
