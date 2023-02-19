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
        // code di bawah hanya untuk jawa barat
        // $provinces = Province::where('id', 32)->first();
        $provinces = Province::where('id', Auth::user()->provinces_id)->first();
        $regencies = Regency::where('id', Auth::user()->regencies_id)->first();
        //$regenciesall = Regency::all();
        //dd($regencies);
        return view('pages.dashboard-account',[
          'user' => $user,
          'provinces' => $provinces,
          'regencies' => $regencies,
          //'regenciesall' => $regenciesall,          
        ]);
    }

    public function update(Request $request, $redirect){
        $data = $request->all();
        $item = Auth::user();
        $item->update($data);

        return redirect()->route($redirect);
    }
}
