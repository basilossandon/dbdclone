<?php

namespace App\Http\Controllers;
use App\Receipt;
use App\User;
use App\PaymentMethod;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
    {
        return Receipt::all();
    }

    public function createOrEdit()
    {
        return view('receipts');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxReceipt = Receipt::find($request->id);
        if($auxReceipt == null){
            $receipt = new Receipt();
            $receipt->updateOrCreate([
                'receipt_ammount' => $request->reservation_date,
                'receipt_date' => $request->reservation_ip,
                'receipt_type' => $request->receipt_type
            ]);
        }
        else{
            $receipt = new Receipt();
            $receipt->updateOrCreate([
                'id' => $request->id,
            ], 
                ['receipt_ammount' => $request->reservation_date,
                'receipt_date' => $request->reservation_ip,
                'receipt_type' => $request->receipt_type
            ]);   
        }
        return Receipt::all();
    }

    public function show($id)
    {
        return Receipt::find($id);
    }

    public function destroy($id)
    {
        $receipt = Receipt::find($id);
        $receipt->delete();
        return Receipt::all();
    }

    public function showPaymentMethod($userId, $receiptId){
        $user = User::find($userId);
        $receipt = $user->receipts()->where('id', $receiptId)->first();
        if ($receipt == null){
          echo 'EL USUARIO '.$userId. ' NO TIENE ACCESO AL RECIBO '. $receiptId;
          return null;
        }
        return $receipt->paymentMethod;
    }

    public function showReservation($userId, $receiptId){
        $user = User::find($userId);
        $receipt = $user->receipts()->where('id', $receiptId)->first();
        if ($receipt == null){
          echo 'EL USUARIO '.$userId. ' NO TIENE ACCESO AL RECIBO '. $receiptId;
          return null;
        }
        return $receipt->reservation;
    }
}
