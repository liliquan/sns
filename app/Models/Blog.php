<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Cache;

class Blog extends Model
{
    protected $fillable = ['title','content','accessable'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public static function ajaxnewblogs(){
        return Blog::where('accessable','public')
         ->orderBy('id','desc')
         ->with('user')
         ->paginate(5);
     }

     public static function top10(){
         return Cache::remember('top10',3,function(){
            return Blog::select('id','title','created_at')
                        ->where('accessable','public')
                        ->orderBy('score','desc')
                        ->take(10)
                        ->get();
        });
     }

    public static function viewAndAddDisplay($blog_id){
        $blog = Blog::find($blog_id);
        $blog->increment('display');
        return $blog;
    } 

}
