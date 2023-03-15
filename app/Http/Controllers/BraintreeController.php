<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Developer;
use App\Models\Sponsor;
use DateTime;

class BraintreeController extends Controller
{
    public function token(Request $request){

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();

        return Inertia::render('Braintree/Test', ['token' => $clientToken]);
        
    }

    public function pay(Request $request){
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $nonceFromTheClient = $request->payment_method_nonce;
        $amount = $request->amount;
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
              'submitForSettlement' => True
            ]
        ]);
        if($result->success){
            $developer = Developer::with('sponsors')->find(Auth::id());
            if($amount == 2.99) $plan = 1;
            elseif($amount == 5.99) $plan = 2;
            elseif($amount == 9.99) $plan = 3;
            $sponsor = Sponsor::find($plan);
            $sponsorTime = $sponsor -> length;
            $start_date = date('Y-m-d H:i:s');

            foreach($developer->sponsors as $sponsor){
                if(strtotime($start_date) <= strtotime($sponsor->pivot->date_end)) $start_date = $sponsor->pivot->date_end;
            }

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start_date);

            $end_date = $developer -> addSponsorship(
                // generate random DateTime
                $start_date,
                $sponsorTime,
            );

            $developer->sponsors()->attach($plan, [
                'date_start' => $start_date,
                'date_end' => $end_date
            ]);
        }
        return Inertia::render('Braintree/Result', ['result' => $result, 'developer' => $developer]);
    }
}
