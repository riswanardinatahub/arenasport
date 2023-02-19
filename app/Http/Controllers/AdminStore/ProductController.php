<?php

namespace App\Http\Controllers\AdminStore;

use App\User;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
           

            $query = Product::where('status','APPROVE')->with(['user.villages','category','galleries'])
            ->whereHas('user', function($coba){
                $coba->where('villages_id', Auth::user()->villages_id);
            })->get(); //->withTrashed(); untuk memanggil data yang telah dihapus

            //dd($query);

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                        <a href="'.route('editproduk', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                                <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger"> Hapus </a>
                        ';
            // })->addColumn('photos', function($item){
            //      return $item->galleries->first()->photos ? '<img src="'.  Storage::url($item->galleries->first()->photos)  .'" style="max-height: 40px;"/>' : '';
            })->addColumn('image', function ($query) { 
            $url= Storage::url($query->galleries->first()->photos ?? '/assets/product/no-photo.png');

            //dd($url);
            return '<img src="'.$url.'" border="0" width="60" class="img-rounded" align="center" />';
        })
            ->rawColumns(['image','action'])->make();  
         }


        //  <div class="btn-group">
        //                     <div class="dropdown">
        //                     <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
        //                         Action
        //                     </button>
        //                     <div class="dropdown-menu">
        //                         <a href="'.route('editproduk', $item->id).'" class="dropdown-item">
        //                         Sunting
        //                         </a>
        //                         <form action="'. route('product.destroy', $item->id).'" method="POST">
        //                         '.method_field('delete'). csrf_field() .'

        //                         <button type="submit" class="dropdown-item text-danger">
        //                             Hapus
        //                         </button>
        //                         </form>
        //                     </div>
        //                     </div>
        //                 </div>

        
        return view('pages.adminstore.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('villages_id', Auth::user()->villages_id)
                    ->where('roles','USER')
                    ->get();
        
        $categories = Category::all();
        return view('pages.adminstore.product.create',[
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
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        Product::create($data);

        return redirect()->back()->with(['success' => 'Data Produk Behasil di Tambahkan']);
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

        return view('pages.adminstore.product.edit',[
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
      
        $item = Product::findOrfail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->back()->with(['success' => 'Data Produk Behasil Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::where('id', $id)->delete();
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

     public function pending(){

        if(request()->ajax()){
           

            $query = Product::where('status','PENDING')->with(['user.villages','category','galleries'])
            ->whereHas('user', function($coba){
                $coba->where('villages_id', Auth::user()->villages_id);
            })->get(); //->withTrashed(); untuk memanggil data yang telah dihapus

            //dd($query);

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                        <a href="" class="btn terimaproduk btn-success" data-nama="'.$item->name.'" data-id="'.$item->id.'">
                                Terima
                                </a>
                                <a href="" class="btn tolakproduk btn-danger" data-nama="'.$item->name.'" data-id="'.$item->id.'">
                                Tolak
                                </a>
                        ';
            // })->addColumn('photos', function($item){
            //      return $item->galleries->first()->photos ? '<img src="'.  Storage::url($item->galleries->first()->photos)  .'" style="max-height: 40px;"/>' : '';
            })->addColumn('image', function ($query) { 
            $url= Storage::url($query->galleries->first()->photos ?? '/assets/product/no-photo.png');

            //dd($url);
            return '<img src="'.$url.'" border="0" width="60" class="img-rounded" align="center" />';
        })
            ->rawColumns(['image','action'])->make();  
         }
        return view('pages.adminstore.product.pending');
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
