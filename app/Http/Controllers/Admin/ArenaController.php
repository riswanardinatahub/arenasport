<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Yajra\DataTables\Facades\DataTables;

class ArenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $query = User::where('store_name','<>','')->with(['regencies'])->get();
        //    $query = DB::table('users')
        //             ->join('regencies', 'regencies.id', '=','users.regencies_id')
        //             ->select('users.id as id','users.name as name','users.email as email','users.roles as roles','regencies.name as namadesa','users.store_name as store_name')
        //             ->where('roles','USER')->get();

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '
                
                        <a href="'.route('arena.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                        <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger"> Hapus </a>
                        
                         ';

                        
            })->rawColumns(['action'])->make(true); 
        }

        return view('pages.admin.arena.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.arena.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password']= bcrypt($request->password);
        User::create($data);

        return redirect()->route('arena.index');
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

        return view('pages.admin.arena.edit',[
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

        return redirect()->route('arena.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
