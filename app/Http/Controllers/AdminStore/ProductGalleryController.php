<?php

namespace App\Http\Controllers\AdminStore;

use App\User;
use App\Product;
use App\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
           
        $query = ProductGallery::with(['product'])
            ->whereHas('product.user', function($coba){
                $coba->where('villages_id', Auth::user()->villages_id);
             })->get();
             //->withTrashed(); untuk memanggil data yang telah dihapus

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '<a href="'.route('adminstore-product-gallery.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                                <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger"> Hapus </a>';
            })->editColumn('photos', function($item){
                 return $item->photos ? '<img src="'. Storage::url($item->photos) .'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action','photos'])->make(); 
        }
// <div class="btn-group">
//                             <div class="dropdown">
//                             <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
//                                 Action
//                             </button>
//                             <div class="dropdown-menu">
//                                 <a href="'.route('product-gallery.edit', $item->id).'" class="dropdown-item">
//                                 Edit
//                                 </a>
//                                 <form action="'. route('product-gallery.destroy', $item->id).'" method="POST">
//                                 '.method_field('delete'). csrf_field() .'

//                                 <button type="submit" class="dropdown-item text-danger">
//                                     Hapus
//                                 </button>
//                                 </form>
//                             </div>
//                             </div>
//                         </div>
        
        return view('pages.adminstore.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('user')->whereHas('user', function($coba){
                $coba->where('villages_id', Auth::user()->villages_id);
             })->get();
      
        return view('pages.adminstore.product-gallery.create',[
            'products' => $products,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product','public');
        ProductGallery::create($data);

        return redirect()->route('adminstore-product-gallery.index');
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
        $productgallery = ProductGallery::find($id);
      //dd($productgallery);
        return view('pages.adminstore.product-gallery.edit',\compact('productgallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
     
        // $image = '/storage/'.$item->photos;
        // $path = str_replace('\\','/',public_path());
        // unlink($path.$image);
    
        Storage::disk('local')->delete('public/'.$item->photos);

        $item->photos =$request->file('photos')->store('assets/product','public');
        $item->save();
        return redirect()->back()->with(['success' => 'Data Galeri Behasil di Rubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::where('id', $id)->delete();
            if ($item) {
                return response()->json([
                    'status' => 'success'
                ]);
            }else{
                return response()->json([
                    'status' => 'error'
                ]);
            }
    }
}
