<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Redis;
use Illuminate\Support\Facades\Cache;
use Hash;

class RegisterController extends Controller
{   
    public function mobilecode(Request $req){
        $code = rand(300000,999999);
        $name = 'code-'.$req->mobile;
        Cache::put($name, $code, 1);
        
        Redis::lpush('sms_list',$req->mobile.'-'.$code);
        
    }

    public function register(){
        return view('register.register');
    }
    public function doregister(RegisterRequest $req){
        $name = 'code-'.$req->mobile;
        $code = Cache::get($name);
        if(!$code||$code!=$req->mobile_code){
            return back()->withErrors(['mobile_code'=>'验证码错误']);
        }

        $password=Hash::make($req->password);
        $user = new User;
        $user->username=$req->username;
        $user->password=$password;
        $user->mobile=$req->mobile;
        if($req->hasFile('face') && $req->face->isValid())
        {
            $face = $req->face->store(date('Y-m-d').'face/');
            $user->face = $face;
        }else
        {
            return back()->withErrors(['face'=>'上传出错']);
        }
        $user->save();
        return redirect()->route('login'); 
    }
    public function verification(){
        return view('register.verification');
    }
}
