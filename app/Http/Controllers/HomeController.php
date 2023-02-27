<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Models\District;
use App\Transaction;
use App\Models\Regency;
use App\ProductGallery;
use App\Models\Province;
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
        $regencies = DB::table('regencies')->where('province_id',31)->get();

       

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
            'regencies'=> $regencies,

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

    public function filterdata(Request $request){
        $categories = Category::take(6)->get();
        $regencies = DB::table('regencies')->where('province_id',31)->get();

        $dataarena = $request->arena;
        $datakota = $request->regencies_id;
        $datakategori = $request->category;
        
        if($request->arena != null && $request->regencies_id!= null && $request->category!= null){
            $products = Product::with(['user.regencies','category','galleries'])
                                ->where('status','APPROVE')->latest()
                                ->where('categories_id',$datakategori)
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('regencies_id',$datakota);
                                })->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('store_name', 'like', '%'.$dataarena.'%');
                                })->paginate(32);

        }elseif($request->arena == '' && $request->regencies_id && $request->category){
            $products = Product::with(['user.regencies','category','galleries'])
                                ->where('status','APPROVE')->latest() 
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('regencies_id',$datakota);
                                })->paginate(32);
        }elseif($request->arena && $request->regencies_id  == '' && $request->category){
             $products = Product::with(['user.regencies','category','galleries'])
                                ->where('status','APPROVE')->latest()
                                ->where('categories_id',$datakategori)
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('store_name', 'like', '%'.$dataarena.'%');
                                })->paginate(32);
        }elseif($request->arena && $request->regencies_id && $request->category  == ''){
             $products = Product::with(['user.regencies','category','galleries'])
                                ->where('status','APPROVE')->latest()
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('regencies_id',$datakota);
                                })->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('store_name', 'like', '%'.$dataarena.'%');
                                })->paginate(32);
        }elseif($request->arena && $request->regencies_id  == '' && $request->category == ''){
             $products = Product::with(['user.regencies','category','galleries'])->where('status','APPROVE')->latest()
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('store_name', 'like', '%'.$dataarena.'%');
                                })->paginate(32); 

        }elseif($request->arena == '' && $request->regencies_id  && $request->category == ''){
             $products = Product::with(['user.regencies','category','galleries'])->where('status','APPROVE')->latest()
                                ->whereHas('user', function($coba) use($dataarena,$datakota){
                                    $coba->where('regencies_id', 'like', '%'.$datakota.'%');
                                })->paginate(32);

        }elseif($request->arena == '' && $request->regencies_id == ''  && $request->category ){
             
            $products = Product::with(['user.regencies','category','galleries'])->where('status','APPROVE')->latest()
                                ->where('categories_id',$datakategori)->paginate(32);

             
        }elseif($request->arena == '' && $request->regencies_id == ''  && $request->category== '' ){
            $products = Product::where('status','DATA KOSONG')->paginate(0);
                return view('pages.fillterdata', compact('products','categories','regencies'));

           
        }

        return view('pages.fillterdata', compact('products','categories','regencies'));
    }

    public function profil(){
        $user = Auth::user();
        // code di bawah hanya untuk jawa barat
        // $provinces = Province::where('id', 32)->first();
        $provinces = Province::where('id', Auth::user()->provinces_id)->first();
        $regencies = Regency::where('id', Auth::user()->regencies_id)->first();
        $distric = District::where('id', Auth::user()->districts_id)->first();

        // dd($distric);
        //$regenciesall = Regency::all();
        //dd($regencies);
        return view('auth.profil',[
          'user' => $user,
          'provinces' => $provinces,
          'regencies' => $regencies,
          'distric' => $distric,
          //'regenciesall' => $regenciesall,          
        ]);
        // return view('auth.profil');
    }


    public function profilupdate(Request $request){
            $data = $request->all();
            $item = Auth::user();
            if($request->hasFile('images')){
                $data['images'] = $request->file('images')->store('assets/product','public');
                
            }
        
        
            $item->update($data);

            return redirect()->back()->with(['success' => 'Data Behasil di Update']);
    }

    
    
}
