<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\MembershipType;
use App\Membership;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Product AS StripeProduct;
use Stripe\Price AS StripePrice;

use Laravel\Cashier\Payment;


class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        $stripeUser = $user->createOrGetStripeCustomer();
        
        return view('membership.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
        return view('membership.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $userData = $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'cellphone' => 'required',
            'birthday' => 'date',
            'address' => 'required',
            'postnumber' => 'exists:postnumber,postNummer',
            'gender' => 'in:male,female,other'
        ]);
        
        $user = auth()->user();
        
        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->cellphone = $userData['cellphone'];
        $user->birthday = $userData['birthday'];
        $user->address = $userData['address'];
        $user->postnumber = $userData['postnumber'];
        $user->gender = $userData['gender'];
        $user->self_verified_at = Carbon::now();
        $user->save();
        
        Stripe::setApiKey(ENV('STRIPE_SECRET'));
        $membershipType = MembershipType::first();
        $stripeproduct = StripeProduct::retrieve($membershipType->stripe_product_id);
        #dd($stripeproduct);
        $prices_onetime = StripePrice::all(['product' => $stripeproduct->id, 'type' => 'one_time']);
        $prices_recurring = StripePrice::all(['product' => $stripeproduct->id, 'type' => 'recurring']);
        $price_onetime = $prices_onetime['data'][0];
        $price_recurring = $prices_recurring['data'][0];
        $membership = Membership::firstOrNew(['user_id' => $user->id]);
        $membership->startTime = Carbon::now();
        $membership->stopTime = Carbon::now()->addYear(1);
        $membership->membership_type_id = $membershipType->id;
        $membership->autorenew = $request->input('auto_renew') ? 1 : 0;
        $membership->save();
        $checkout_param = ['success_url' => route('membership.success', $membership->id), 'cancel_url' => route('membership.failed', $membership->id), 'client_reference_id' => 'membership_'.$membership->id];

        if($request->input('auto_renew')) {
            $checkout = $user->newSubscription('membership_subscription_' + $membership->id, $price_recurring->id)->checkout($checkout_param);
        }
        else {
          
            $checkout = $user->checkout($price_onetime->id, $checkout_param);
        }
        Log::channel('organization')->info($user->firstname.' '.$user->lastname." vil bli medlem!");
        return redirect($checkout->url);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function successMembership($id) {
        $user = auth()->user();
        $membership = Membership::find($id);

        return redirect(route('membership.index'))->with('status', "Medlemsskap opprettet! Velkommen ombord!");

    }

    public function failedMembership($id) {
        $user = auth()->user();
        $membership = Membership::find($id);

        if($membership->user_id == $user->id) {
            $membership->delete($id);
        }
        return redirect(route('membership.index'))->with('status', "Medlemsskap ble ikke opprettet. Prøv igjen litt senere");
    }
}
