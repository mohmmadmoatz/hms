<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $appends=["qtynow"];
    public function getQtynowAttribute()
    {
        $exportedQty = WarehouseExportItem::where("product_id",$this->id)->sum("qty");
        return $this->qty - $exportedQty;
    }
}
