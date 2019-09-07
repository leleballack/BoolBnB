<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;
use App\Apartament;
use App\Sponsor;
use App\Sponsortype;
use Carbon\Carbon;
class PaymentsController extends Controller
{
  public function paymentOne($id){
    $apartament = Apartament::find($id);
    $sponsortypes = Sponsortype::all();
    $sponsor = Sponsor::where('apartament_id',$apartament->id)->get();

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $now = Carbon::now();



    $token = $gateway->ClientToken()->generate();

    return view('payment', [
        'token' => $token,
        'sponsortypes' => $sponsortypes,
        'apartament' => $apartament,
        'sponsor' => $sponsor
    ]);
  }

  public function paymentTwo(Request $request){
    $data = $request->all();

      $gateway = new Braintree\Gateway([
          'environment' => config('services.braintree.environment'),
          'merchantId' => config('services.braintree.merchantId'),
          'publicKey' => config('services.braintree.publicKey'),
          'privateKey' => config('services.braintree.privateKey')
      ]);

      $amount = $request->amount;
      $nonce = $request->payment_method_nonce;

      switch ($amount) {
        case "2.99":
          $value = 24;
          break;

        case "5.99":
          $value = 72;
          break;

        case "9.99":
          $value = 144;
          break;
      }


      $result = $gateway->transaction()->sale([
          'amount' => $amount,
          'paymentMethodNonce' => $nonce,
          'customer' => [
              'firstName' => 'Tony',
              'lastName' => 'Stark',
              'email' => 'tony@avengers.com',
          ],
          'options' => [
              'submitForSettlement' => true
          ]
      ]);
      // return dd($data);
      if ($result->success) {
          $transaction = $result->transaction;
          // header("Location: transaction.php?id=" . $transaction->id);
            $now = Carbon::now();
           $new_sponsor = new Sponsor();
           $new_sponsor->apartament_id = $data['apart_id'];
           $new_sponsor->sponsortype_id = $data['sponsort_id'];
           $new_sponsor->start_date = $now;
           $year = $now->year;
           $month = $now->month;
           $day = $now->day;

           $dt = Carbon::create($year,$month,$day,0);
           $new_sponsor->end_date = $dt->addHours($value);
           $new_sponsor->save();
           return dd($data);

           
   //        return redirect()->route('admin.apt.index')->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
   //    } else {
   //        $errorString = "";
   //
   //        foreach ($result->errors->deepAll() as $error) {
   //            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
   //        }
   //
   //        // $_SESSION["errors"] = $errorString;
   //        // header("Location: index.php");
   //        return back()->withErrors('An error occurred with the message: '.$result->message);
      }
    }
}
