<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
      
        $array = array();
        $array["name"] =  $request->name;
        $array["email"] =  $request->email;
        $array["password"] = $request->password;
        $array["phone_number"] = $request->phone_number;
        $array["provinces_id"] = $request->provinces_id;
        $array["regencies_id"] = $request->regencies_id;
        $array["districts_id"] = $request->districts_id;
        $array["villages_id"] = $request->villages_id;
        $array["store_name"] = NULL;
        $array["categories_id"] = NULL;
        $array["store_status"] = 0;
        
        $mail = DB::tabel('users')->where('email',"=",$request->email)->get();
        if($mail->count()>0){
            return response()->json([
                'error'=>1,
                'message'=>'Email sudah terdaftar, silahkan gunakan email lainnya.'
            ],200);
        }else{
 
            if(empty($request->email)||empty($request->password)||empty($request->villages_id)){
                return response()->json([
                    'error'=>1,
                    'message'=>'Tidak boleh ada kolom yang kosong.'
                ],200);
            }else{
                $create = User::create($array);
                if($create){
                    return response()->json([
                        'success'=>1,
                        'message'=>'Akun Berhasil Didaftarkan a.'
                    ],200);
 
                }else{
                    return response()->json([
                        'error'=>1,
                        'message'=>'Terjadi masalah, coba lagi nanti.'
                    ],200);
                }
            }
 
 
        }

    }


     public function update(Request $request, $id)
    {
        User::where('email', $id)
       ->update([
           'name' => $request->name
        ]);


        // $user = User::where($id);
        // if($user->count()){
        //     $user->name = $request->name;
        //     if($user->save()){
        //         return 'Data Behasil Di Update';
        //     }
        // }else{
        //     return 'gak ketemu';
        // }


        // $product = Product::find($id);
        // $product->nama = $request->nama;
        // $product->kategori = $request->kategori;
        // $product->harga = $request->harga;

        // if($product->save()){
        //     return 'Data Behasil Di Update';
        // }
    }
}
