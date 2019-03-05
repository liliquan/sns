<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassWordController extends Controller
{
    public function modifypwd(){
        return view('password.modifypwd');
    }

    public function forgetpwd(){
        return view('password.forgetpwd');
    }

    public function newpwd(){
        return view('password.newpwd');
    }
}
