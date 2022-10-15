<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouseproduct extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $appends=["qtynow",'incomeqty','exportqty'];
    

    public function base()
    {
        return $this->belongsTo(Unit::class, 'baseunit');
    }

    public function getIncomeqtyAttribute()
    {
        $income = WarehouseItem::where("product_id",$this->id)->sum("qty");
        return $income;
    }

    public function getExportqtyAttribute()
    {
        $export = WarehouseExportItem::where("product_id",$this->id)->sum("qty");
        return $export;
    }

    public function getQtynowAttribute()
    {
      
        return $this->incomeqty - $this->exportqty;
    }

}
