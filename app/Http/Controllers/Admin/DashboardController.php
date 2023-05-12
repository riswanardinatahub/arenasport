<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Product;

use Carbon\Carbon;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //berdasarkan month Jumlah User
        $users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $month = User::select(\DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('month');
        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($month as $index => $month) {
            // $datas[$month]= $users[$index];
            $datas[$month-1]=$users[$index];
        }

        $statistikuser= json_encode($datas);

        //berdasarkan month Jumlah Transaksi
        $transaksi = TransactionDetail::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
                    
        $monthtransaksi = TransactionDetail::select(\DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('month');
                   
        $datatransaksi = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($monthtransaksi as $index => $month) {
            // $datas[$month]= $users[$index];
            $datatransaksi[$month-1]=$transaksi[$index];
        }
        
        // $statistiktransaksi= json_encode($datatransaksi);

        //dd($datatransaksi);


        //category

        $coba = TransactionDetail::selectRaw(\DB::raw("COUNT(*) as count"))
                ->groupBy('products_id')
                ->pluck('count');
       //dd($coba);
                
        $product = Product::select('name')->get();

        
        $dataproduk =[];
        foreach ($product as $value) {
            $dataproduk[] = $value->name;
        }
       

        $category = TransactionDetail::with('product')->whereHas('product', function($product){
            $product->where('categories_id', 3);
        })->count();

        //dd($category);


        
         $userss = User::selectRaw("COUNT(*) views, DATE_FORMAT(created_at, '%Y %m %e') date")
            ->groupBy('date')
            ->pluck('views')->take(7);
            $now = Carbon::now();
            $week=  User::whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->select([DB::raw("COUNT(*) as count"),DB::raw('DATE(created_at) as day')])
                    ->groupBy('day')
                    ->orderBy('day', 'asc')
                    ->pluck('count')->take(7);

        //    dd($week);

                $data = User::select([
                // This aggregates the data and makes available a 'count' attribute
                DB::raw('count(id) as `count`'), 
                // This throws away the timestamp portion of the date
                DB::raw('DATE(created_at) as day')
                // Group these records according to that day
                ])->groupBy('day')
                // And restrict these results to only those created in the last week
                ->where('created_at', '>=', $now->subWeeks(1))
                ->get();

                $output = [];
                foreach($data as $entry) {
                    $output[$entry->day] = $entry->count;
                }


        $transactiondata = TransactionDetail::with(['transaction.user','product.galleries']);

           // dd($statistikuser);
    
        $customer = User::count();
        $transaction = Transaction::count();
        $revenue = Transaction::where('transaction_status','SUCCESS')->sum('total_price');

        $lapanganpending = Product::where('status','PENDING')->count();
        $transaction_data = Transaction::take(5)->latest()->get();

        // dd($lapanganpending);
        return view('pages.admin/dashboard',[
            'customer' => $customer,
            'transaction' => $transaction,
            'transaction' => $transaction,
            'revenue' => $revenue,
            'lapanganpending' => $lapanganpending,
            'statistikuser' => $statistikuser,
            'datatransaksi' => $datatransaksi,
            'transaction_data' => $transaction_data,
        ]);
    }
}