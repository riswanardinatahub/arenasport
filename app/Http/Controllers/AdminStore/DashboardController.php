<?php

namespace App\Http\Controllers\AdminStore;

use App\User;
use App\Product;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        

        $product = Product::with(['user.villages','category','galleries'])
            ->whereHas('user', function($coba){
                $coba->where('villages_id', Auth::user()->villages_id);
            });   

        $customer = User::where('villages_id', Auth::user()->villages_id)->count()-1;

         $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('transaction.user', function($product){
            $product->where('villages_id', Auth::user()->villages_id);
        });

        //dd($kamuuua);

        //$transaction = Transaction::count();
        $revenue = Transaction::with(['user'])->whereHas('user', function($user){
            $user->where('villages_id', Auth::user()->villages_id);
        })->where('transaction_status','SUCCESS')->sum('total_price');
        //dd($revenue);
        //$revenue = Transaction::where('transaction_status','SUCCESS')->sum('total_price');
        return view('pages.adminstore.dashboard',[
            'customer' => $customer,
            'revenue' => $revenue,
            'product_total' => $product->count(),
            'transaction_total' => $transaction->count(),
            'transaction_data' => $transaction->take(5)->latest()->get(),
        ]);
    }
}
