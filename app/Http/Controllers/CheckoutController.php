<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request){

    $checkifdatahavebeenchaeckout = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();
        foreach($checkifdatahavebeenchaeckout as $rowdata){
             $detailtransaction = TransactionDetail::
                                  where('products_id',$rowdata->products_id)
                                ->where('book_time',$rowdata->book_time)
                                ->where('book_date',$rowdata->book_date)->count();
            // dd($detailtransaction);
            if($detailtransaction >=1){
             return redirect()->back()->with(['success' => 'Mohon maaf jadwal anda telah dipesan oleh orang lain, silahkan hapus dan pilih jadwal lain']);
            }
        }
    
     //ambil user   
     $user = Auth::user();
    //  $user->update($request->except('total_price','total_qty'));

     //proses checkout
     $code = 'ARENA-'. mt_rand(000000, 999999);
     $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();

        //insert transaction
        $transaction = Transaction::create([
            'users_id'=> Auth::user()->id,
            'arena_id'=> $request->arena_id,
            'inscurance_price'=> 0,
            'shipping_price'=> 0,
            'total_price'=> $request->total_price,
            'transaction_status'=> 'PENDING' ,
            'code'=> $code,

        ]);

       

        $takeidtarnsaction = $transaction->id;
    
        //transaction details
            foreach ($carts as $cart) {
                $trx = 'TRX-'. mt_rand(000000, 999999);
                
                $transaction = TransactionDetail::create([
                    'transactions_id'=> $takeidtarnsaction,
                    'products_id'=> $cart->product->id,
                    'price'=> $cart->product->price,
                    'book_date'=> $cart->book_date,
                    'book_time'=> $cart->book_time,
                    'shipping_status'=> 'PENDING',
                    'resi'=> 'PENDING',
                    'total_qty'=> 1,
                    'code'=> $trx,

                ]);
            }

    //delete cart data after checkout
    Cart::where('users_id', Auth::user()->id)->delete();

    // return redirect('/dashboard/transactions');
    return view('pages.success');


    // //midtrans
    // // Set your Merchant Server Key
    //     Config::$serverKey = config('services.midtrans.serverKey');
    //     Config::$isProduction = config('services.midtrans.isProduction');
    //     Config::$isSanitized = config('services.midtrans.isSanitized');
    //     Config::$is3ds = config('services.midtrans.is3ds');
    // //membuat array untuk di kirim ke midtrans
    //     $midtrans =[
    //         'transaction_details'=>[
    //             'order_id' => $code,
    //             'gross_amount' =>(int) $request->total_price,
    //         ],
    //         'customer_details'=>[
    //             'first_name' => Auth::user()->name,
    //             'email' =>Auth::user()->email,
    //         ],
    //         'enabled_payments' => [
    //             'gopay','permata_va','bank_transfer'
    //         ],
    //         'vtweb' => [],
    //     ];


    //     try {
    //     // Get Snap Payment Page URL
    //     $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
        
    //     // Redirect to Snap Payment Page
    //     return redirect($paymentUrl);
    //     }
    //     catch (Exception $e) {
    //     echo $e->getMessage();
    //     }
        
    }

     public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if ($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }
        else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();

        // Kirimkan email
        
    }



    
}

