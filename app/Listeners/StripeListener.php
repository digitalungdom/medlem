<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Log;

use App\Membership;
use App\User;
use Laravel\Cashier\Cashier;
use Carbon\Carbon;

class StripeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        //
        if(isset($event->payload['data']['object'])) $object = $event->payload['data']['object'];
        if(isset($object['client_reference_id'])) $reference_id = explode("_",$object['client_reference_id']);
        /* if ($event->payload['type'] === 'charge.succeeded') {
            $object = $event->payload['data']['object'];
            #Log::debug($object);
            $user = Cashier::findBillable($object['customer']);
            $membership = Membership::where('user_id', $user->id)
                ->where('is_paid', false)
                ->first();
            $membership->stripe_payment_id = $object['id'];
            $membership->is_paid = 1;
            $membership->stopTime = Carbon::now()->addYear(1);
            $membership->save();

        } */

        if ($event->payload['type'] === 'checkout.session.completed' && $reference_id[0] == 'membership') {
            
            #Log::debug($object);
            $user = Cashier::findBillable($object['customer']);
            $membership = Membership::find($reference_id[1]);
            $membership->stripe_payment_id = $object['id'];
            $membership->is_paid = 1;
            $membership->last_paid = Carbon::now();
            $membership->stopTime = Carbon::now()->addYear(1);
            $membership->save();

        }

        else {
            #Log::debug($event->payload);
        }
    }
}
