<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
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
        return view('pages.detail',[
            'product' => $product,
        ]);
    }

    public function add(Request $request, $id){
        $data = [
            'products_id'=> $id,
            'users_id'=> Auth::user()->id,
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
