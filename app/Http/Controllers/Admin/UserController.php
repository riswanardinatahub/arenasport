<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UserRequest;
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
         
                    // dd($query);
            
       if(request()->ajax()){
            $query = User::with(['regencies'])->get();
        //    $query = DB::table('users')
        //             ->join('regencies', 'regencies.id', '=','users.regencies_id')
        //             ->select('users.id as id','users.name as name','users.email as email','users.roles as roles','regencies.name as namadesa','users.store_name as store_name')
        //             ->where('roles','USER')->get();

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                
                        <a href="'.route('user.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                        <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger"> Hapus </a>
                        
                         ';

                        
            })->rawColumns(['action'])->make(true); 
        }

        // <div class="btn-group">
                //             <div class="dropdown">
                //             <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                //                 Action
                //             </button>
                //             <div class="dropdown-menu">
                //                 <a href="'.route('user.edit', $item->id).'" class="dropdown-item">
                //                 Sunting
                //                 </a>
                //                 <form action="'. route('user.destroy', $item->id).'" method="POST">
                //                 '.method_field('delete'). csrf_field() .'

                //                 <button type="submit" class="dropdown-item text-danger ">
                //                     Hapus
                //                 </button>
                //                 </form>
                //             </div>
                //             </div>
                //         </div>

        // <a href="'. route('delete-user', $item->id).'" class="btn btn-sm btn-danger delete-confirm" data-id="'.$item->name.'">Delete</a>
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        // Http::post('https://desaku-desacuss.masuk.id/api/register', [
        //                 'email' => $request->email,
        //                 'password' => Hash::make($request->password),
        //                 'id_desa' => $request->villages_id,
        //                 'name' => $request->name,
        //                 'role' => 2,
        //                 'from' => 'desastore',
        //                 'action' => 'createadmindesa',
        //                 'desc' => Auth::user()->email,
        //             ])->json();

        // Http::post('https://desaku-desatour.masuk.id/api/register', [
        //             'name'     =>  $request->name,
        //             'password' =>  Hash::make($request->password),
        //             'desa'     =>  $request->villages_id,
        //             'email'    =>  $request->email,
        //         ])->json();


    
        $data = $request->all();

        $data['password']= bcrypt($request->password);
        User::create($data);

        return redirect()->route('admin-store-user.index');
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
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit',[
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
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
      
        $item = User::findOrfail($id);
          if($request->password){
              $data['password'] = bcrypt($request->password);
          }else{
              unset($data['password']);
          }
          
        $item->update($data);

        return redirect()->route('admin-store-user.index');
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
