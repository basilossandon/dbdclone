<?php

use Illuminate\Database\Seeder;

class ReceiptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receipts = factory(App\Receipt::class, 100)->create();
        $receipts->each(function ($receipt){
            $paymentMethod = factory(App\PaymentMethod::class)->create();
            $reservation = factory(App\Reservation::class)->create();
            $receipt->payment_method_id = $paymentMethod->id;
            $receipt->reservation_id = $reservation->id;
            $receipt->save();
        });
    }
}
