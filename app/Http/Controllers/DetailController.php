<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Schedule;
use App\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DetailController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request , $id)
    {
        $product = Product::with(['galleries','user'])->where('slug',$id)->firstOrFail();
         $schedule = Schedule::where('products_id',$product->id)->where('status','yes')->get();


        //  dd($transactiondetail);

         $now = Carbon::now();
         $monday = $now->startOfWeek();
         $tuesday = $monday->copy()->addDay();
         $wednesday = $tuesday->copy()->addDay();
         $thursday = $wednesday->copy()->addDay();
         $friday = $thursday->copy()->addDay();
         $saturday = $friday->copy()->addDay();
         $sunday = $saturday->copy()->addDay();

         $transactiondetailmonday = TransactionDetail::where('products_id',$product->id)->where('book_date',$monday->format('Y-m-d'))->get();
         $transactiondetailtuesday = TransactionDetail::where('products_id',$product->id)->where('book_date',$tuesday->format('Y-m-d'))->get();
         $transactiondetailwednesday= TransactionDetail::where('products_id',$product->id)->where('book_date',$wednesday->format('Y-m-d'))->get();
         $transactiondetailthursday = TransactionDetail::where('products_id',$product->id)->where('book_date',$thursday->format('Y-m-d'))->get();
         $transactiondetailfriday = TransactionDetail::where('products_id',$product->id)->where('book_date',$friday->format('Y-m-d'))->get();
         $transactiondetailsaturday = TransactionDetail::where('products_id',$product->id)->where('book_date',$saturday->format('Y-m-d'))->get();
         $transactiondetailsunday = TransactionDetail::where('products_id',$product->id)->where('book_date',$sunday->format('Y-m-d'))->get();

       

        //   dd($monday->format('Y-m-d'),$tuesday->format('Y-m-d'),$wednesday->format('Y-m-d'),
        //     $thursday->format('Y-m-d'),$friday->format('Y-m-d')
        // ,$saturday->format('Y-m-d'),$sunday->format('Y-m-d'));

        return view('pages.detail',[
            'product' => $product,
            'schedule' => $schedule,
            'transactiondetailmonday' => $transactiondetailmonday,
            'transactiondetailtuesday' => $transactiondetailtuesday,
            'transactiondetailwednesday' => $transactiondetailwednesday,
            'transactiondetailthursday' => $transactiondetailthursday,
            'transactiondetailfriday' => $transactiondetailfriday,
            'transactiondetailsaturday' => $transactiondetailsaturday,
            'transactiondetailsunday' => $transactiondetailmonday,
        ]);
    }

    public function add(Request $request, $id){
        // dd($request->all());

        $datacart = Cart::where('users_id',Auth::user()->id)->first();
        $datacartproduct = Cart::where('users_id',Auth::user()->id)->get();

        foreach ($datacartproduct as $datamasuk) {
            if($datamasuk->users_id == Auth::user()->id && $datamasuk->book_date == $request->book_date && $datamasuk->book_time == $request->book_time && $datamasuk->products_id == $id){
             return redirect()->route('cart')->with(['success' => 'Mohon Maaf Jadwal Sudah Di Tambahkan']);
            }
            if($datamasuk->arena_id <> $request->arena_id){
             return redirect()->route('cart')->with(['success' => 'Kamu Hanya Bisa Memilih Sesuai Arena Kamu Atau Kamu Bisa Lakukan Checkout Terlebih Dahulu Kemudian Pilih Arena Baru']);
            }

        }


        


        $data = [
            'products_id'=> $id,
            'book_date'=> $request->book_date,
            'book_time'=> $request->book_time,
            'users_id'=> Auth::user()->id,
            'arena_id'=> $request->arena_id,
        ];

        $produk = Product::find($id);

        $jumlah = $produk->stock - 1;
        $produk->update(['stock'=> $jumlah]);
        $produk->save();

        Cart::create($data);


        return redirect()->route('cart');


       
       
    }

    public function tambahqty($id){
        $cart = Cart::find($id);

        $produk = Product::find($cart->products_id);

        if($produk->stock == 0){
            return redirect()->back()->with(['success' => 'Mohon Maaf Stok Produk Sudah Habis']);
        }

        $jumlah = $produk->stock - 1;
        $produk->update(['stock'=> $jumlah]);
        $produk->save();
       
        $jumlah = $cart->qty + 1;
        $cart->update(['qty'=> $jumlah]);
        $cart->save();
        return redirect()->back();
    }

    public function kurangqty($id){
        $cart = Cart::find($id);

        $produk = Product::find($cart->products_id);

        if($cart->qty == 1){
            return redirect()->back()->with(['success' => 'Minimal Beli Adalah Satu']);
        }

        $jumlah = $produk->stock + 1;
        $produk->update(['stock'=> $jumlah]);
        $produk->save();
       
        $jumlah = $cart->qty - 1;
        $cart->update(['qty'=> $jumlah]);
        $cart->save();
        return redirect()->back();
    }


}
