<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Product;
use App\ProductGallery;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getproduct(){
         return Product::with('user','galleries')->take(10)->latest()->get();
    }

    public function getproductvillage($village){
       
        return Product::with(['user.villages','category','galleries'])
            ->whereHas('user', function($coba) use ($village){
                $coba->where('villages_id', $village);
            })->take(10)->latest()->get();
  
    }

    public function productterlaris(){


        // $transaction =  DB::table('transaction_details')
        //     ->join('products', 'products.id', '=', 'transaction_details.products_id')
        //     ->select('products_id as id_produk','products.*', DB::raw('COUNT(products_id) as jumlah_terjual'), 'products_id')
        //     ->groupBy('products_id')
        //     ->orderBy('jumlah_terjual','DESC')
        //     ->get();

        // $collectid = [];
        // $datafoto = [];
        // foreach ($transaction as  $value) {
        //     $collectid[] = $value->products_id;
        //     $datafoto[] = ProductGallery::where('products_id',$value->products_id)->first();
        // }

        // $gallery = ProductGallery::whereIn('products_id',$collectid)->groupBy('products_id')->select('products_id','photos')->get();
            
        //     // $gallery[] = ProductGallery::where('products_id',$item)->get();
        //    return response()->json([
        //         'status' => 'success',
        //         'transaction' => $transaction,
        //         'datafoto' => $datafoto
        //    ]);
       

        // $datafoto = ProductGallery::whereIn('products_id',$collectid)->get();

        // dd($datafoto);

        // $uniqueData = array_unique($data);
        // $hasil = count($uniqueData);

            // $item =  DB::table('transaction_details')->groupBy('products_id')
            //                                         ->select()
            //                                         ->orderBy(DB::raw('COUNT(products_id)'))
            //                                         ->pluck('products_id');
            
            // $item = collect($item)->sortBy('count')->reverse()->toArray();
                                                    // $reverse = array_reverse($item, true);
            // dd($item);

            // $kamu =['2','3'];

            

            // return DB::table('transaction_details')
            // ->join('products', 'products.id', '=', 'transaction_details.products_id')
            // ->join('product_gallaries','product_gallaries.products_id','=','transaction_details.products_id')
            //  ->select('transaction_details.products_id','photos',
            //           DB::raw('COUNT(transaction_details.products_id) as jumlah_terjual')
            //          )
            // // ->select('transaction_details.products_id','products.*', 
            // //         DB::raw('COUNT(transaction_details.products_id) as jumlah_terjual'),
            // //          'transaction_details.products_id','photos')
            // ->where('shipping_status', 'SUCCESS')
            // ->groupBy(DB::raw('product_gallaries.products_id'))
            // ->orderBy('transaction_details.products_id','ASC')
            // ->get();


             return DB::table('transaction_details')
            ->join('products', 'products.id', '=', 'transaction_details.products_id')
            ->select('transaction_details.products_id','products.*', 
                    DB::raw('COUNT(transaction_details.products_id) as jumlah_terjual'),
                     'transaction_details.products_id')
            // ->where('shipping_status', 'SUCCESS')
            ->groupBy('transaction_details.products_id')
            ->orderBy('jumlah_terjual','DESC')
            ->take(5)
            ->get();

        
        // return DB::table('products')
        //             ->join('product_gallaries','product_gallaries.products_id','=','products.id')
        //             ->join('transaction_details','transaction_details.products_id','=','products.id')
        //             ->select('transaction_details.products_id as id_produk','products.name', DB::raw('COUNT(transaction_details.products_id) as jumlah_terjual'), 'transaction_details.products_id')
        //             ->groupBy('transaction_details.products_id')
        //             ->orderBy('jumlah_terjual','DESC')
        //             ->get();


        // return DB::table('products')
        //             ->join('product_gallaries','product_gallaries.products_id','=','products.id')
        //             ->get();
    }

    public function produkgalleri($id){
        return ProductGallery::where('products_id',$id)->get();
    }

    
}
