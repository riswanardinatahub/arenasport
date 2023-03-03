<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\Schedule;

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
        // dd($request->param);
        
        $data = $request->all(); 
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        // dd($product->id);

       $gallery = [
           'products_id' =>$product->id,
           'photos' => $request->file('photo')->store('assets/product','public'),
       ];

        ProductGallery::create($gallery);

    $test = array('00.00 - 01.00','00.10 - 02.00','02.00 - 03.00','03.00 - 04.00','04.00 - 05.00','05.00 - 06.00','06.00 - 07.00','07.00 - 08.00','08.00 - 09.00'
            ,'09.00 - 10.00','10.00 - 11.00','11.00 - 12.00','12.00 - 13.00','13.00 - 14.00',
            '14.00 - 15.00','15.00 - 16.00','16.00 - 17.00','17.00 - 18.00','18.00 - 19.00',
            '19.00 - 20.00','20.00 - 21.00','21.00 - 22.00','22.00 - 23.00','23.00 - 24.00',);
    foreach($test as $datawaktu) {
    $data = array('products_id' => $product->id,
                    'time' => $datawaktu, 
                    'status' => 'open');
    Schedule::insert($data);  
    }
        //  dd($data);

        // for ($x = 0; $x < 24; $x++){
        //      $data = 1+$x;
        //      Schedule::insert($data);
        // }

    // $test = array(123, 231, 321, 543);
    // foreach($test as $key) {
    // $data = array('name' => 'test_name', 'test' => $key, 'property' => 'test_property');
    // Test_table::insert($data);    
    // }

       
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
