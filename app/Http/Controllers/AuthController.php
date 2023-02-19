<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function autoLogin(Request $request)
    {
        $user = User::where('email',$request->email)
        ->where('villages_id',$request->id_desa)->first();
        if($user){
            if(Auth::loginUsingId($user->id, true)){
                return redirect()->intended('/');
            }
        }else{
            return redirect()->intended('/');
        }

    }

}
