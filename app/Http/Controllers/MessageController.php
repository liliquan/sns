<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function content(){
        return view('message.content');
    }
    public function mymessage(){
        return view('message.mymessage');
    }
    public function send(){
        return view('message.send');
    }
}
