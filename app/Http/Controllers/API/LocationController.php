<?php

namespace App\Http\Controllers\API;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function provinces(Request $request){
        // return Province::all();
        return DB::table('provinces')->where('id',31)->get();
    }

     public function regencies(Request $request){
        // return Regency::where('province_id',$provinces_id)->get();
        return DB::table('regencies')->where('province_id',31)->get();
    }

    public function districts(Request $request, $regencies_id){
        // return District::where('regency_id',$regencies_id)->get();
        return DB::table('districts')->where('regency_id',$regencies_id)->get();

        
    }

    public function villages(Request $request, $districts_id){
        // return Village::where('district_id',$districts_id)->get();
        return DB::table('villages')->where('district_id',$districts_id)->get();

    }
}
