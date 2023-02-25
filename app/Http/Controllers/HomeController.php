<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Transaction;
use App\ProductGallery;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::where('status','APPROVE')->latest()->with(['galleries'])->take(20)->get();

        $desaterpopuler = Transaction::all();
        
        $data =[];
        foreach ($desaterpopuler as $value) {
            $data[] = $value->user->villages->id;
        }
        
        $occurences = array_count_values($data);
        //print_r($occurences);
        arsort( $occurences );
        //dd($occurences);

        $produkterlaris = DB::table('transaction_details')
            ->join('products', 'products.id', '=', 'transaction_details.products_id')
            ->select('products_id as id_produk','products.*', DB::raw('COUNT(products_id) as jumlah_terjual'), 'products_id')
            ->groupBy('products_id')
            ->orderBy('jumlah_terjual','DESC')
            ->take(5)->get();
     


    //    $produk_gallery = ProductGallery::where('products_id','2')->get();
       
    //    dd($produk_gallery);



        return view('pages.home',[
            'categories'=> $categories,
            'products'=> $products,
            'produkterlaris'=> $produkterlaris,
            'occurences'=> $occurences,

            ]);
    }

    public function rank(){
         $desaterpopuler = Transaction::all();
        
        $data =[];
        foreach ($desaterpopuler as $value) {
            $data[] = $value->user->villages->id;
        }
        
        $occurences = array_count_values($data);
        //print_r($occurences);
        arsort( $occurences );
        //dd($occurences);

        return view('detailrangking',compact('occurences'));
    }


    public function kamu(){
        Storage::delete('public/storage/assets/product/jDughGwNGCTmYWkc6WVlu3yJSz2fIrzTyrm1gSlr.jpg');
        
    }

    public function registerpartner(){
        $categories = Category::all();
        return view('auth.registermitra',[
            'categories' => $categories,
        ]);
        // return view('auth.registermitra');
    }
    
}
