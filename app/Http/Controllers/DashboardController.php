<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Auth::user();
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        });


        $revenue = $transaction->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });


        $customer = TransactionDetail::with(['transaction.user','product','transaction'])
        ->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        })->get();

       //dd($customer);
        $data=[];
        foreach ($customer as  $value) {
            $data[] = $value->transaction->user->id;  
        }
        $uniqueData = array_unique($data);
        $hasil = count($uniqueData);
         //dd(count($uniqueData));

         $totalproduct = Product::with('user')->where('users_id',Auth::user()->id)->count();


        return view('pages.dashboard',[
            'trasaction_count' => $transaction->count(),
            'trasaction_data' => $transaction->get(),
            'revenue' => $revenue,
            'customer' => $customer,
            'hasil' => $hasil,
            'totalproduct' => $totalproduct,

        ]);
    }
}
