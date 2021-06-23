<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Auth;
use File;
use Hash;
use JWTAuthException;

class AccountController extends Controller
{
    private $account;

    public function __construct(Account $account){
        $this->account = $account;
    }

    public function login(Request $request)
    {
        $withEmailData = [
            'email' => $request->username, 
            'password' => $request->password
        ];
        
        $withPhoneData = [
            'phone_number' => $request->username, 
            'password' => $request->password
        ];
        
        $access_token = null;
        
        if(Auth::attempt($withEmailData) || Auth::attempt($withPhoneData)){
            $user = Auth::user();
            $access_token = Auth::user() ->createToken('token') ->plainTextToken;
            $arr =[
                "status" => "success",
                "message" => "Đăng nhập thành công",
                "data" => $access_token
            ];
        }else{
            $arr =[
                "status" => "fail",
                "message" => "Sai tên tài khoản hoặc mật khẩu",
                "data" => null
            ];
        }
        
        return response()->json($arr, 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:255',
            'name' => 'required|max:255',       
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'gender' => 'required|numeric|min:0|max:1',
            'phone_number' => 'required|digits:10',
            'address' => 'required|string'
        ]);
        if (!$validator->fails()) {
            try {
                Account::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' =>$request->name,
                    'date_of_birth' => $request->date_of_birth, 
                    'gender' => $request->gender,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address
                ]);
            } catch (Exception $e) {
            
            }
        }else{
            return response()->json($validator ->messages(), 500);
        }
    }

    public function getAccountData(){
        return Auth::user();
    }
  
    public function check()
    {
        if(Auth::check()){
            echo "Đã đăng nhập";
        }
        
    }

    public function logout()
    {
        // dd(Auth::user() ->tokens());
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        
        $arr =[
            "status" => "success",
            "message" => "Đã đăng xuất",
            "data" => null
        ];

        return response() ->json($data, 200);
    }

    
}
