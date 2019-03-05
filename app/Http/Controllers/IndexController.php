<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class IndexController extends Controller
{
    public function ajaxnewblogs(){
        $blog = Blog::ajaxnewblogs();
        return $blog;
    }

    public function index(){

        $acUsers = User::acUsers();

        $top10 = Blog::top10();
        return view('index.index',[
            'acUsers'=>$acUsers,
            'top'=>$top10,
            ]);
    }

    public function blog($blog_id){
        $blog = Blog::viewAndAddDisplay($blog_id);
        $top10 = Blog::top10();
        return view('index.blog',[
        'blog'=>$blog,
        'top'=>$top10,
        ]);
    }

    public function cj(){
        return view('index.ceshi');
    }
}
