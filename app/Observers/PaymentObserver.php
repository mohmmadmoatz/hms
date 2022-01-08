<?php

namespace App\Observers;

use App\Models\Payments;

class PaymentObserver
{
    /**
     * Handle the Payments "created" event.
     *
     * @param  \App\Models\Payments  $payments
     * @return void
     */
    public function created(Payments $payments)
    {
        //
        $lastNumber = Payments::withTrashed()
        ->where("payment_type",$payments->payment_type)
        ->count("wasl_number");
       
        $payments->wasl_number=$lastNumber;
        $payments->save();
    }

    /**
     * Handle the Payments "updated" event.
     *
     * @param  \App\Models\Payments  $payments
     * @return void
     */
    public function updated(Payments $payments)
    {
        //
    }

    /**
     * Handle the Payments "deleted" event.
     *
     * @param  \App\Models\Payments  $payments
     * @return void
     */
    public function deleted(Payments $payments)
    {
        //
    }

    /**
     * Handle the Payments "restored" event.
     *
     * @param  \App\Models\Payments  $payments
     * @return void
     */
    public function restored(Payments $payments)
    {
        //
    }

    /**
     * Handle the Payments "force deleted" event.
     *
     * @param  \App\Models\Payments  $payments
     * @return void
     */
    public function forceDeleted(Payments $payments)
    {
        //
    }
}
