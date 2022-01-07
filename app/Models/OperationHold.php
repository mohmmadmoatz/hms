<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationHold extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function Patient()
    {
        return $this->belongsTo("App\Models\Patient",'patinet_id');
    }

    
    public function doctor()
    {
        return $this->belongsTo("App\Models\User",'doctor_id');
    }

}
