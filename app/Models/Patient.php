<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class Patient extends Model
{
    use HasFactory,Loggable;
	 protected $guarded = [];  
     public function stage()
     {
         return $this->belongsTo("App\Models\Stage", 'status');
     }

     /**
      * Get the doctor that owns the Patient
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function doctor()
     {
         return $this->belongsTo("App\Models\User", 'doctor_id');
     }

     public function room()
     {
         return $this->belongsTo("App\Models\Room", 'room_id');
     }
     

     /**
      * Get the operation that owns the Patient
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function operation()
     {
         return $this->belongsTo("App\Models\Operation", 'opration_id');
     }
 }

