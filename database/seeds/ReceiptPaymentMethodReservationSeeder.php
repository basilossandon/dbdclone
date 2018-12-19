<?php

use Illuminate\Database\Seeder;

class ReceiptPaymentMethodReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++){
          $paymentMethod = factory(App\PaymentMethod::class)->create();
          $receipt = factory(App\Receipt::class)->create();
          $reservation = factory(App\Reservation::class)->create();
          DB::table('receipts')->where('id', $i)->update(
            ['payment_method_id' => $paymentMethod->id,
             'reservation_id' => $reservation->id]
          );
        }
    }
}
