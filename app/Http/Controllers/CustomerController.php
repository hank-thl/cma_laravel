<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    function createUser (Request $request)
    {
        $memberAccount = Customer::where('member_account', '=', "$request->memberAccount")->get();
        $memberEmail = Customer::where('member_email', '=', "$request->memberEmail")->get();
        if($memberAccount!='[]')return response("That account is taken", Response::HTTP_UNAUTHORIZED);
        if($memberEmail!='[]')return response("That email is taken", Response::HTTP_UNAUTHORIZED);
        // 密碼加密
        $hashPassword = Hash::make("$request->memberPassword");
        $addMember = Customer::insert(
                [
                    'member_account' => "$request->memberAccount",
                    'member_password' => "$hashPassword",
                    'member_lastname' => "$request->memberLastname",
                    'member_firstname' => "$request->memberFirstname",
                    'member_gender' => "$request->memberGender",
                    'member_nickname' => "$request->memberNickname",
                    'member_email' => "$request->memberEmail",
                    'member_tel'=> "$request->memberTel",
                    'member_addr'=> "$request->memberAddr",
                    'member_birth'=> "$request->memberBirth",
                    'create_user'=> 'Admin',
                    'create_date'=> now(),
                    'update_user'=> 'Admin',
                    'update_date'=> now(),
                ]
            );
        return response($addMember, Response::HTTP_CREATED);
    }

    function login(Request $request)
    {
        // 從資料庫取出前端輸入會員帳號，若無直接回傳
        $member = Customer::where('member_account', '=', "$request->memberAccount")->get();
        if($member=='[]')return response('Account does not exist',Response::HTTP_BAD_REQUEST);
        // 有帳號則比對密碼
        if (Hash::check("$request->memberPassword", $member[0]->member_password)) // 比對密碼
        {
            // 密碼比對成功，將會員存入Session，回傳memberId
            session()->put('member', $member[0]);
            return response()->json([
                'memberId' => $member[0]->member_id,
            ]);
        }
        // 比對失敗
        return response('Incorrect Password',Response::HTTP_UNAUTHORIZED);;
    }

    function getMember(){
        // 從Session取得會員資料並回傳
        $member = session()->get('member', "");
        if($member) {
            return response()->json([
                'memberId' => $member->member_id,
                'memberAccount' => $member->member_account,
                'memberFirstname' => $member->member_firstname,
                'memberLastname' => $member->member_lastname,
                'memberNickname' => $member->member_nickname,
                'memberEmail' => $member->member_email,
                'memberTel' => $member->member_tel,
                'memberAddr' => $member->member_addr,
                'memberGender' => $member->member_gender,
            ]);
        };
        return response()->json([
            'memberId' => 0, 
        ]);
    }

    function logout(){
        session()->forget('member');
        return response("logout succeed",Response::HTTP_ACCEPTED);
    }
}
