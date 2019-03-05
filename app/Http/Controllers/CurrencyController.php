<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function success(){
        return view('currency.success');
    }
    public function fail(){
        return view('currency.fail');
    }
}
