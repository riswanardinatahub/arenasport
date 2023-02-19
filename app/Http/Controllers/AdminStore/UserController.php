<?php

namespace App\Http\Controllers\AdminStore;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $query = User::with(['villages'])->where('villages_id', Auth::user()->villages_id)->where('roles','USER');
            
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                        <a href="'.route('adminstore-user.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                        <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger"> hapus </a>';
            })->rawColumns(['action'])->make(true); 
        }
        //  <div class="btn-group">
        //                     <div class="dropdown">
        //                     <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
        //                         Aksi
        //                     </button>
        //                     <div class="dropdown-menu">
        //                         <a href="'.route('adminstore-user.edit', $item->id).'" class="dropdown-item">
        //                         Sunting
        //                         </a>
        //                         <form action="'. route('adminstore-user.destroy', $item->id).'" method="POST">
        //                         '.method_field('delete'). csrf_field() .'

        //                         <button type="submit" class="dropdown-item text-danger ">
        //                             Hapus
        //                         </button>
        //                         </form>
        //                     </div>
        //                     </div>
        //                 </div>
        
        return view('pages.adminstore.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.adminstore.user.create');
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

        $data['password']= bcrypt($request->password);
        $data['provinces_id']= Auth::user()->provinces_id;
        $data['regencies_id']= Auth::user()->regencies_id;
        $data['districts_id']= Auth::user()->districts_id;
        $data['villages_id']= Auth::user()->villages_id;

        User::create($data);

        return redirect()->back()->with(['success' => 'Data User Behasil di Tambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item = User::findOrFail($id);
        
        return view('pages.adminstore.user.edit',[
            'item' => $item
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
        
        $item = User::findOrfail($id);
          if($request->password){
              $data['password'] = bcrypt($request->password);
          }else{
              unset($data['password']);
          }
          
        $item->update($data);
        

        return redirect()->route('adminstore-user.index')->with(['success' => 'Data User Behasil di Rubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::where('id', $id)->delete();
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
