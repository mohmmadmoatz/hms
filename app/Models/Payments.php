<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Get the user that owns the Payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }


    public function doctor()
    {
        return $this->belongsTo("App\Models\User",'doctor_id');
    }


    /**
     * Get the Patient that owns the Payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Patient()
    {
        return $this->belongsTo("App\Models\Patient",'patinet_id');
    }
}
