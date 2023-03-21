<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackOfficeUser;
use Mockery\Undefined;
use Session;

class BackOfficeController extends Controller
{
    function login(){
        return view('BackOffice.login');
    }

    function postLogin(Request $request){
        $user = BackOfficeUser::where('user_account', '=', "$request->username")->get();
        // dd("$user"=="[]");
        if($user=='[]')return redirect('BackOffice');

        if($request->password == $user[0]->user_password){
            // 將user加入session
            $request->session()->put('userName', "$request->username");
            return view('BackOffice.index', compact('user'));
        }
        else{
            return redirect('BackOffice');
        }        
    }
    function products(){
        return view('BackOffice.products');
    }
}
