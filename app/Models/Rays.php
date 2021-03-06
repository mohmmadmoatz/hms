<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rays extends Model
{
	 protected $guarded = [];  
     
     public function patient()
     {
         return $this->belongsTo("App\Models\Patient", 'patient_id');
     }
    use HasFactory;
}
