<?php

namespace App\Http\Controllers\Admin;
use App\Product;
use App\User;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

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
                return '<div class="btn-group">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a href="'.route('product.edit', $item->id).'" class="dropdown-item">
                                Edit
                                </a>
                                <form action="'. route('product.destroy', $item->id).'" method="POST">
                                '.method_field('delete'). csrf_field() .'

                                <button type="submit" class="dropdown-item text-danger">
                                    Hapus
                                </button>
                                </form>
                            </div>
                            </div>
                        </div>';
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
        $users = User::all();
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
        Product::create($data);

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
        $categories = Category::all();
        $item = Product::findOrFail($id);

        return view('pages.admin.product.edit',[
            'item' => $item,
             'users' => $users,
            'categories' => $categories,

            
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

        return redirect()->route('product.index');
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
