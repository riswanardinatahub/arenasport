<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-settings',[
          'user' => $user,
          'categories' => $categories,
             
        ]);
    }

     public function account()
    {
        $user = Auth::user();
        $categories = Category::all();
        // code di bawah hanya untuk jawa barat
        // $provinces = Province::where('id', 32)->first();
        $provinces_get = Province::where('id', Auth::user()->provinces_id)->first();
        if($provinces_get){
            $provinces = Province::where('id', Auth::user()->provinces_id)->first();
        }else{
            $provinces = Province::where('id', 31)->first();

        }
        $regencies_get = Regency::where('id', Auth::user()->regencies_id)->first();
        if($regencies_get){
            $regencies = Regency::where('id', Auth::user()->regencies_id)->first();
        }else{
            $regencies = Regency::where('province_id', 31)->first();

        }
        //$regenciesall = Regency::all();
        //dd($regencies);
        return view('pages.dashboard-account',[
          'user' => $user,
          'provinces' => $provinces,
          'regencies' => $regencies,
          'categories' => $categories,
          //'regenciesall' => $regenciesall,          
        ]);
    }

    public function update(Request $request, $redirect){

        $data = $request->all();
        $item = Auth::user();
        if($request->hasFile('images')){
            $data['images'] = $request->file('images')->store('assets/product','public');
            
        }

        if($request->hasFile('arena_photos')){
            $data['arena_photos'] = $request->file('arena_photos')->store('assets/product','public');
            
        }
        
        
        $item->update($data);

        return redirect()->route($redirect);
    }
}
