<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\Follow;

class FriendController extends Controller
{
    public function gz($user_id){
        $id = session('id');

        $f = new Follow;
        $f->user_id=$id;
        $f->follow_id=$user_id;
        $f->save();

        return [
            'error'=>0,
            'gx'=>'gz'
        ];
    }

    public function qxgz($user_id){
        $id = session('id');

        $gx = Friend::gx($user_id);
        if($gx=='gz'){

            Follow::where('user_id',$id)
            ->where('follow_id',$user_id)
            ->delete();
            
            return [
                'error'=>0,
                'gx'=>'no',
            ];
        }
        else
        {
            return [
                'error'=>1,
                'gx'=>'操作有误,关系不对应',
            ];
        }

    }

    public function tjhy($user_id){
        $id = session('id');

        $gx = Friend::gx($user_id);
        if($gx=='fs'){

            Follow::where('user_id',$user_id)
            ->where('follow_id',$id)
            ->delete();
            
            Friend::insert([
                ['user_id'=>$id,'friends_id'=>$user_id],
                ['user_id'=>$user_id,'friends_id'=>$id],
            ]);

            return [
                'error'=>0,
                'gx'=>'hy',
            ];
        }
        else
        {
            return [
                'error'=>1,
                'gx'=>'操作有误,关系不对应',
            ];
        }

    }

    public function schy($user_id){
        $id = session('id');

        $gx = Friend::gx($user_id);
        if($gx=='hy'){

            Friend::where(function($q) use($id,$user_id){
                $q->where('user_id',$id)
                    ->where('friends_id',$user_id);
            })
            ->orWhere(function($q) use($id,$user_id){
                $q->where('friends_id',$user_id)
                ->where('user_id',$id);
            })
            ->delete();
            
            Follow::insert([
                'user_id'=>$user_id,
                'follow_id'=>$id,
            ]);

            return [
                'error'=>0,
                'gx'=>'fs',
            ];
        }
        else
        {
            return [
                'error'=>1,
                'gx'=>'操作有误,关系不对应',
            ];
        }

    }

}
