<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;
class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
    public function dologin(LoginRequest $req){
        
        $user = User::where('mobile',$req->mobile)->first();
        if($user)
        {
            if(Hash::check($req->password, $user->password))
            {
                $captcha = $req->session()->pull('captcha');

                if($req->captcha==''||$captcha!=$req->captcha)
                {
                    return back()->withInput()->withErrors(['captcha'=>'验证码输入错误']);
                }

                session([
                    'id'=>$user->id,
                    'username'=>$user->username,
                    'mobile'=>$user->mobile,
                    'smface'=>$user->smface,
                    'bgface'=>$user->bgface,
                ]);
                return redirect()->route('index');
            }
            else
            {
                return back()->withInput()->withErrors(['password'=>'密码不正确']);
            }
        }
        else{
            return back()->withInput()->withErrors(['mobile'=>'手机号不存在']);
        }
        
    }
}
