<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(request()->ajax()){
            $query = Category::query();

            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                            <div class="row  m-0  p-0">
                            <div class="col-6 m-0">
                            <a href="'.route('category.edit', $item->id).'" class="btn btn-warning">
                                Edit
                                </a>
                                
                            </div>

                            <div class="col-6 m-0 p-0">
                             <form action="'. route('category.destroy', $item->id).'" method="POST">
                                '.method_field('delete'). csrf_field() .'

                                <button type="submit" class="btn btn-danger" Onclick="return ConfirmDelete()">
                                    Hapus
                                </button>
                                </form>
                                
                            </div>

                            </div>
                            <script>
                                function ConfirmDelete()
                                {
                                    return confirm("Apakah kamu yakin ingin menghapus data ini ? ");
                                }
                            </script>    
                            ';
            })->editColumn('photo',function($item){
                return $item->photo ? '<img src="'. Storage::url($item->photo) .'" style="max-height: 40px;"/>' : '';
            })->rawColumns(['action','photo'])->make(); 
        }

        
        return view('pages.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category','public');

        Category::create($data);

        return redirect()->route('category.index');
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
        $item = Category::findOrFail($id);

        return view('pages.admin.category.edit',[
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
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category','public');

        $item = Category::findOrfail($id);
        $item->update($data);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        return redirect()->route('category.index');
    }
}
