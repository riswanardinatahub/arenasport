<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $query = Transaction::with(['user','arena']); //->withTrashed(); untuk memanggil data yang telah dihapus

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                        
                        <div class="row  m-0  p-0">
                            <div class="col-6 m-0">
                            
                                <a href="'.route('transaction.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                                
                            </div>

                            <div class="col-6 m-0 p-0">
                             

                                <form action="'. route('transaction.destroy', $item->id).'" method="POST">
                                '.method_field('delete'). csrf_field() .'

                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                                </form>
                                
                            </div>

                           
                            </div>
                        
                        
                        
                        
                        
                        ';
            })->rawColumns(['action'])->editColumn('status', function ($inquiry) {
                if ($inquiry->transaction_status == 'PENDING') return 'Belum Bayar';
                if ($inquiry->transaction_status == 'SUCCESS') return 'Lunas';
                return 'DP';
                })->editColumn('time', function ($user) 
                {
                    //change over here
                    return date('d-m-Y', strtotime($user->created_at) );
                })
            
            ->make(); 
        }

        
        return view('pages.admin.transaction.index');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit',[
            'item' => $item,
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
      
        $item = Transaction::findOrfail($id);
        $item->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();
        return redirect()->route('transaction.index');
    }
}
