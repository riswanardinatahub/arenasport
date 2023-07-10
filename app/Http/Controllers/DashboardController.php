<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Transaction;
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

        $totattransaksi = Transaction::where('arena_id',Auth::user()->id)->where('transaction_status','SUCCESS')->sum('total_price');
        $totaltransaksisemua = Transaction::where('arena_id',Auth::user()->id)->count();

        $transaction_data = Transaction::where('arena_id', Auth::user()->id)->take(5)->latest()->get();


        $produkterlaris = DB::table('transaction_details')
            ->join('products', 'products.id', '=', 'transaction_details.products_id')
            ->where('products.users_id',Auth::user()->id)
            ->select('products_id as id_produk','products.*', DB::raw('COUNT(products_id) as jumlah_terjual'), 'products_id')
            ->groupBy('products_id')
            ->orderBy('jumlah_terjual','DESC')
            ->take(5)->get();

            //dd($produkterlaris);



        // dd($totattransaksi);
        return view('pages.dashboard',[
            'trasaction_count' => $transaction->count(),
            'trasaction_data' => $transaction_data,
            'revenue' => $revenue,
            'customer' => $customer,
            'hasil' => $hasil,
            'totalproduct' => $totalproduct,
            'totattransaksi' => $totattransaksi,
            'produkterlaris' => $produkterlaris,
            'totaltransaksisemua' => $totaltransaksisemua,

        ]);
    }
}
