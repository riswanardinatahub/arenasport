<?php

namespace App\Http\Controllers\AdminStore;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
           

            $query = Transaction::with(['user.villages'])
            ->whereHas('user', function($data){
                $data->where('villages_id', Auth::user()->villages_id);
            })->get(); //->withTrashed(); untuk memanggil data yang telah dihapus

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '';
            })->rawColumns(['action'])->make(); 
        }
// <div class="btn-group">
//                             <div class="dropdown">
//                             <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
//                                 Edit
//                             </button>
//                             <div class="dropdown-menu">
//                                 <a href="'.route('transaction.edit', $item->id).'" class="dropdown-item">
//                                Hapus
//                                 </a>
//                                 <form action="'. route('transaction.destroy', $item->id).'" method="POST">
//                                 '.method_field('delete'). csrf_field() .'

//                                 <button type="submit" class="dropdown-item text-danger">
//                                     Hapus
//                                 </button>
//                                 </form>
//                             </div>
//                             </div>
//                         </div>
        
        return view('pages.adminstore.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
