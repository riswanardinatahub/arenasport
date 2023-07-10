<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $transaction = Transaction::where('users_id', Auth::user()->id)->get();
        // // dd($transaction);
        // $buytransaction = TransactionDetail::with(['transaction.user','product.galleries'])
        // ->whereHas('transaction', function($transaction){
        //     $transaction->where('users_id', Auth::user()->id);
        // })->get();

        // return view('pages.dashboard-transactions',[
        //     'buytransaction' => $buytransaction,
        //     'transaction' => $transaction,
        // ]);


        $selltransaction = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        })->get();

        $buytransaction = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('transaction', function($transaction){
            $transaction->where('users_id', Auth::user()->id);
        })->get();

        $transaction = Transaction::where('arena_id', Auth::user()->id)->latest()->get();

        return view('pages.dashboard-transactions',[
            'selltransaction' => $selltransaction,
            'buytransaction' => $buytransaction,
            'transaction' => $transaction,
        ]);
    }

    public function details(Request $request, $id)
    {
        // $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
        // ->findOrFail($id);
        // return view('pages.dashboard-transactions-details',[
        //     'transaction'=> $transaction
        // ]);


         $transaction = Transaction::find($id);
         $transactionss = Transaction::find($id);
         

        $transactiondetails = TransactionDetail::with(['transaction.user','product.galleries'])
        ->where('transactions_id',$id)->get();

        $jumlahproduk = TransactionDetail::with(['transaction.user','product.galleries'])
        ->where('transactions_id',$id)->count();

        // dd($transactiondetail);
        return view('pages.dashboard-transactions-details',[
            'transactiondetails'=> $transactiondetails,
            'jumlahproduk'=> $jumlahproduk,
            'transaction'=> $transaction,
            'transactionss'=> $transactionss
        ]);
    }

    public function update(Request $request, $id){

        // dd($id);
        $item = Transaction::find($id);

        $item->update([
            'transaction_status' => $request->transaction_status,
            'down_payment' => $request->down_payment
        ]);

        return redirect()->back();
    }


    
    public function konfirmasistatuscustomer($id){

        $item = Transaction::find($id);

        $item->update([
            'status_transaction_customer' => 'SUCCESS'
        ]);

        return redirect()->back();
    }

    public function konfirmasistatuspenjual($id){
        $item = Transaction::find($id);

        $item->update([
            'transaction_status' => 'SUCCESS'
        ]);

        return redirect()->back();
    }

    public function transactionsreport(){

        $result = Transaction::where('transaction_status','SUCCESS')
                                ->where('arena_id',Auth::user()->id)
                                ->selectRaw('year(created_at) year, monthname(created_at) month,  sum(total_price) data')
                                ->groupBy('year', 'month')
                                ->orderBy('year', 'desc')
                                ->get();

        // dd($result);
        return view('pages.dashboard-report-transactions', compact('result'));
    }


}
