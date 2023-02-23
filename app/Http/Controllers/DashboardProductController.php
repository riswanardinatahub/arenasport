<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;

class DashboardProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $products = Product::latest()->with('user','galleries','category')->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products',[
            'products' => $products,
        ]);
    }

     public function details(Request $request, $id)
    {
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details',[
            'product' => $product,
            'categories' => $categories,
        ]);
    }


    public function uploadGallery(Request $request){
       
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product','public');
        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details',$request->products_id);
    }

    public function deleteGallery(Request $request, $id){
        $item = ProductGallery::findOrFail($id);
        $image = '/storage/'.$item->photos;
        $path = str_replace('\\','/',public_path());
        if(file_exists($path.$image)){
            
            unlink($path.$image);
            $item->delete();
            return redirect()->route('dashboard-product-details',$item->products_id);
        }else{
            $item->delete();
            return redirect()->route('dashboard-product-details',$item->products_id);
        }
        
        
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create',[
            'categories' => $categories,
        ]);
    }


    public function store(ProductRequest $request)
    {
        $data = $request->all(); 
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

       $gallery = [
           'products_id' =>$product->id,
           'photos' => $request->file('photo')->store('assets/product','public'),
       ];

        ProductGallery::create($gallery);

       
        return redirect()->route('dashboard-product');
    }

     public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
      
        $item = Product::findOrfail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('dashboard-product');
    }


}
