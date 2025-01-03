<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function payment(){
        return view('payment');
    }
    public function processPayment(){
        return view('processPayment');
    }
    public function pay(Request $request){
        // payment logic
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Charge::create([
            "amount" => Session::get('cart_total') * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment"
        ]);
        $order_id = Session::get('order_id');
        $order = Order::find($order_id);
        $order->status = "paid";
        $order->save();
        Session::flash('success', 'Payment successful!');
        return view('invoice');
        // return redirect()->route('invoice')->withErrors(['message' => 'Payment success']);
        

    }

    public function invoice(){
        return view('invoice');
    }
}
