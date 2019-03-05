<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public $timestamps = false;

    public static function gx($userId){
        
        $myid = session('id');

        if(!$myid)
        {
            return "no";
        }
        if($userId==$myid){
            return "me";
        }
        
        $f = Friend::where('user_id',$myid)
                    ->where('friends_id',$userId)
                    ->count();

        if($f>0)
        {
            return "hy";
        }
        else
        {
            $f = Follow::where('user_id',$myid)
            ->where('follow_id',$userId)
            ->count();

            if($f>0)
            {
                return 'gz'; 
            }
            else
            {
                $f = Follow::where('user_id',$userId)
                ->where('follow_id',$myid)
                ->count();
                
                return $f>0?'fs':'no';
            }
        }

    }
}
