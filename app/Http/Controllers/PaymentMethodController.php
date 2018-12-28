<?php

namespace App\Http\Controllers;
use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return PaymentMethod::all();
    }

    public function createOrEdit()
    {
        return view('paymentmethods');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxpaymentMethod = PaymentMethod::find($request->id);
        if($auxpaymentMethod == null){
            $paymentMethod = new PaymentMethod();
            $paymentMethod->updateOrCreate([
                'payment_account_number' => $request->payment_account_number,
                'payment_method_name' => $request->payment_method_name,
                'payment_method_type' => $request->payment_method_type
            ],[]);
        }
        else{
            $paymentMethod = new PaymentMethod();
            $paymentMethod->updateOrCreate([
                'id' => $request->id,
            ], 
                ['payment_account_number' => $request->payment_account_number,
                'payment_method_name' => $request->payment_method_name,
                'payment_method_type' => $request->payment_method_type
            ]);   
        }
        return PaymentMethod::all();
    }

    public function show($id)
    {
        return PaymentMethod::find($id);
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();
        return PaymentMethod::all();
    }
}
