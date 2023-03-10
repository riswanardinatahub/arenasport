<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Product;
use App\Category;
use App\Schedule;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(request()->ajax()){
            $query = Product::where('status','APPROVE')->with(['user','category','galleries']); //->withTrashed(); untuk memanggil data yang telah dihapus

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                        <div class="row  m-0  p-0">
                            <div class="col-6 m-0">
                            
                               
                                 <a href="'.route('product.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                                
                            </div>

                            <div class="col-6 m-0 p-0">
                             

                                


                                <form action="'. route('product.destroy', $item->id).'" method="POST">
                                '.method_field('delete'). csrf_field() .'

                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                                </form>
                                
                            </div>

                           
                            </div>
                            
                            ';
            // })->addColumn('photos', function($item){
            //      return $item->galleries->first()->photos ? '<img src="'.  Storage::url($item->galleries->first()->photos)  .'" style="max-height: 40px;"/>' : '';
            })->addColumn('image', function ($query) { 
            $url= Storage::url($query->galleries->first()->photos ?? '/assets/product/DUDakSlEJ0C2QJK3U7lmdY7ApB747JsUa46kpV0U.jpg');

            //dd($url);
            return '<img src="'.$url.'" border="0" width="60" class="img-rounded" align="center" />';
        })
            ->rawColumns(['image','action'])->make();  
        }

        
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::where('store_name', '<>', '')->where('phone_number', '<>', '')
                            ->where('address_one', '<>', '')->where('categories_id', '<>', '')
                            ->where('provinces_id', '<>', '')->where('regencies_id', '<>', '')
                            ->where('arena_photos', '<>', '')->get();
        
        $categories = Category::all();
        return view('pages.admin.product.create',[
            'users' => $users,
            'categories' => $categories,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    $test = array('00.00 - 01.00','00.10 - 02.00','02.00 - 03.00','03.00 - 04.00','04.00 - 05.00','05.00 - 06.00','06.00 - 07.00','07.00 - 08.00','08.00 - 09.00'
            ,'09.00 - 10.00','10.00 - 11.00','11.00 - 12.00','12.00 - 13.00','13.00 - 14.00',
            '14.00 - 15.00','15.00 - 16.00','16.00 - 17.00','17.00 - 18.00','18.00 - 19.00',
            '19.00 - 20.00','20.00 - 21.00','21.00 - 22.00','22.00 - 23.00','23.00 - 24.00',);
            
    $datajadwal = array($request->time1,$request->time2,$request->time3,$request->time4,$request->time5,$request->time6,$request->time7,$request->time8
                        ,$request->time9,$request->time10,$request->time11,$request->time12,$request->time13,$request->time14,$request->time15,$request->time16
                        ,$request->time17,$request->time18,$request->time19,$request->time20,$request->time21,$request->time22,$request->time23,$request->time24);
   
                        // $datajadwaltostring = implode(", ", $datajadwal);

    // $codes = array('tn', 'us', 'fr');
    // $names = array('Tunisia', 'United States', 'France');
    foreach($test as $key => $value) {
        // echo "Code is: " . $test[$key] . " - " . "and Name: " . $datajadwal[$key] . "<br>";
        $data = array('products_id' => $product->id,
                    'time' => $test[$key], 
                    'status' => $datajadwal[$key]);
        Schedule::insert($data);
    }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
         

      
        $users = User::all();
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();
        $schadules = Schedule::where('products_id',$id)->get();

        return view('pages.admin.product.edit',[
            'product' => $product,
             'users' => $users,
            'categories' => $categories,
            'schadules' => $schadules,

            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
      
        $item = Product::findOrfail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        $galleydelete = ProductGallery::where('products_id',$item->id);
        $galleydelete->delete();
        $item->delete();
        return redirect()->route('product.index');
    }

    public function pending(){

        if(request()->ajax()){
           

            $query = Product::where('status', '<>', 'APPROVE')
                                    ->with(['user.regencies','category','galleries'])->get(); //->withTrashed(); untuk memanggil data yang telah dihapus

            //dd($query);

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                if($item->status == 'NOTAPPROVE' ){
                        return ' 
                               
                        ';
                }else{
                    return ' 
                        <a href="" class="btn terimaproduk btn-success" data-nama="'.$item->name.'" data-id="'.$item->id.'">
                                Terima
                                </a>
                                <a href="" class="btn tolakproduk btn-danger" data-nama="'.$item->name.'" data-id="'.$item->id.'">
                                Tolak
                                </a>
                        ';
                }
                
            // })->addColumn('photos', function($item){
            //      return $item->galleries->first()->photos ? '<img src="'.  Storage::url($item->galleries->first()->photos)  .'" style="max-height: 40px;"/>' : '';
            })->addColumn('image', function ($query) { 
            $url= Storage::url($query->galleries->first()->photos ?? '/assets/product/no-photo.png');

            //dd($url);
            return '<img src="'.$url.'" border="0" width="60" class="img-rounded" align="center" />';
        })
            ->rawColumns(['image','action'])->make();  
         }
        return view('pages.admin.product.pending');
    }




    public function terima($id){
        $data = Product::find($id);

        if($data->status == 'PENDING'){
            $data->update(['status' => 'APPROVE']); 
        }else{
            $data->update(['status' => 'NOTAPPROVE']); 
        }

        $data->save();
        return redirect()->back();

    }

     public function tolak($id){
        $data = Product::find($id);

        if($data->status == 'PENDING'){
            $data->update(['status' => 'NOTAPPROVE']); 
        }

        $data->save();
        return redirect()->back();

    }

    

   
}
