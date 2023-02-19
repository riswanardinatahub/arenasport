<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AdminStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $query = User::with(['villages'])->where('roles','ADMINSTORE');

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return '<div class="btn-group">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a href="'.route('user.edit', $item->id).'" class="dropdown-item">
                                Sunting
                                </a>
                                <form action="'. route('user.destroy', $item->id).'" method="POST">
                                '.method_field('delete'). csrf_field() .'

                                <button type="submit" class="dropdown-item text-danger ">
                                    Hapus
                                </button>
                                </form>
                            </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" data-toggle="tooltip" onClick="Delete(this.id)" id="'.$item->id.'" data-original-title="Delete"
                        class="btn btn-danger btn-sm"> hapus </a>
                        
                         ';

                        
            })->rawColumns(['action'])->make(true); 
        }

        // <a href="'. route('delete-user', $item->id).'" class="btn btn-sm btn-danger delete-confirm" data-id="'.$item->name.'">Delete</a>
        return view('pages.admin.user-admin-store.index');
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
