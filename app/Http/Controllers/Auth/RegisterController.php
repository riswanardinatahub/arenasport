<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('auth.register',[
            'categories' => $categories,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'store_name' => ['nullable', 'string', 'max:255'],
            'categories_id' => ['nullable', 'integer', 'exists:categories,id'],
            'is_store_open' => ['required']
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // dd($data);
        // Http::post('https://desaku-desacuss.masuk.id/api/register', [
        //                 'email' => $data['email'],
        //                 'password' => Hash::make($data['password']),
        //                 'id_desa' => $data['villages_id'],
        //                 'name' => $data['name'],
        //                 'from' => 'Desa Store',
        //                 'action' => 'create',
        //                 'desc' => 'Mandiri',
        //             ])->json();


        // Http::post('https://desaku-desafeed.masuk.id/api/register', [
        //             'role'          =>  'USER',
        //             'username'      =>  Str::slug($data['name']) ,
        //             'password'      =>  Hash::make($data['password']),
        //             'nama'          =>  $data['name'],
        //             'regency_id'    =>  $data['regencies_id'],
        //             'district_id'   =>  $data['districts_id'],
        //             'village_id'    =>  $data['villages_id'],
        //             'email'         =>  $data['email'],
        //             'nomor_hp'      =>  $data['phone_number'],
        //             'foto_profil'   =>  NULL
        //         ])->json();

        $request = app('request');

        if($request->hasFile('arena_photos')){
            $data['arena_photos'] = $request->file('arena_photos')->store('assets/product','public');
            
        }

    //    dd($data['arena_photos']);
  

    
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'arena_photos' => isset($data['arena_photos']) ? $data['arena_photos'] : NULL,
            'phone_number' => isset($data['phone_number']) ? $data['phone_number'] : NULL,
            'password' => Hash::make($data['password']),
            'provinces_id' => isset($data['provinces_id']) ? $data['provinces_id'] : NULL,
            'regencies_id' => isset($data['regencies_id']) ? $data['regencies_id'] : NULL,
            'districts_id' => isset($data['districts_id']) ? $data['districts_id'] : NULL,
            'villages_id' => isset($data['villages_id']) ? $data['villages_id'] : NULL,
            'store_name' => isset($data['store_name']) ? $data['store_name'] : NULL,
            'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
            'store_status' => isset($data['is_store_open']) ? 1 : 0,

        ]);
    }

    public function success(){
        return view('auth.success');
    }

    public function check(Request $request){
        return User::where('email', $request->email)->count() > 0 ? 'Unvailable' : 'Available';
    }

    // public function register(Request $request)
    // {

    //     $array = array();
    //     $array["name"] =  $request->name;
    //     $array["email"] =  $request->email;
    //     $array["password"] = Hash::make($request->password);
    //     $array["phone_number"] = $request->phone_number;
    //     $array["provinces_id"] = $request->provinces_id;
    //     $array["regencies_id"] = $request->regencies_id;
    //     $array["districts_id"] = $request->districts_id;
    //     $array["villages_id"] = $request->villages_id;
    //     $array["store_name"] = NULL;
    //     $array["categories_id"] = NULL;
    //     $array["store_status"] = 0;
 
    //     $mail = User::where('email',"=",$request->email)->get();
    //     if($mail->count()>0){
    //         return response()->json([
    //             'error'=>1,
    //             'message'=>'Email sudah terdaftar, silahkan gunakan email lain.'
    //         ],200);
    //     }else{
 
    //         if(empty($request->email)||empty($request->password)||empty($request->villages_id)){
    //             return response()->json([
    //                 'error'=>1,
    //                 'message'=>'Tidak boleh ada kolom yang kosong.'
    //             ],200);
    //         }else{
    //             $create = User::create($array);
    //             if($create){
    //                 return response()->json([
    //                     'success'=>1,
    //                     'message'=>'Akun Berhasil Didaftarkan.'
    //                 ],200);
 
    //             }else{
    //                 return response()->json([
    //                     'error'=>1,
    //                     'message'=>'Terjadi masalah, coba lagi nanti.'
    //                 ],200);
    //             }
    //         }
 
 
    //     }

    // }

}
