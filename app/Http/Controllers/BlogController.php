<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Ding;
use DateTime;
use DB;
use Storage;

class BlogController extends Controller
{   
    public function ding($blog_id){
        $has = Ding::where('user_id',session('id'))
                ->where('blog_id',$blog_id)
                ->count();
        
        if($has==0){
            $blog_id = (int)$blog_id;
            if($blog_id==0){
                return [
                    'error'=>1,
                    'errmsg'=>'警告!!参数不正确!',
                ];
            }
            $blog = Blog::find($blog_id);

            if(!$blog){
                return [
                    'error'=>1,
                    'errmsg'=>'警告!!参数不正确!',
                ];
            }
            $blog->increment('zhan',1,['score'=>DB::raw('score+300')]);
            $ding = new Ding;
            $ding->fill([
                'user_id'=>session('id'),
                'blog_id'=>$blog_id,
            ]);
            $ding->save();
            return [
                'error'=>0,
            ];
        }
        else
        {
            return [
                'error'=>3,
                'errmsg'=>'只能顶一次!',
            ];
        }

    }
    public function write(){
        return view('blog.write');
    }
    // 日志列表s
    public function myblog(Request $req){

        $data =Blog::where('user_id',session('id'));
        if($req->keyword)
        {
            $data->where(function($q) use ($req){
                $q->where('title','like',"%$req->keyword%")
                  ->orwhere('content','like',"%$req->keyword%");
            });
        }

        if($req->from)
        {
            // array_merge
            $data->where('created_at','>=',$req->from);
        }
        if($req->to)
        {
            $data->where('created_at','<=',$req->to);
        }

        if($req->acc)
        {
            $data->where('accessable',$req->acc);
        }

        $data->orderBy('created_at',$req->od);
        $data = $data->paginate(2);

        return view('blog.myblog',[
            'data'=>$data,
            'req'=>$req,
            ]);
    }
    // 日志列表E
    public function edit($id){
        $data = Blog::find($id);
        if($data->user_id!=session('id')){
            return back();
        }
        return  view('blog.edit',['data'=>$data]);
    }
    public function doedit(BlogRequest $req,$id){
        $blog = Blog::find($id);
        if($blog->user_id!=session('id')){
            return back();
        }
        $blog->fill($req->all());

        if($req->hasFile('logo') && $req->logo->isValid())
        {
            $logo = $req->logo->store(date('Y-m-d'));
            Storage::delete($blog->image);
            $blog->image = $logo;
        }

        $blog->save();

        return redirect()->route('myblog'); 
    }
    
    public function delete($id){
        $blog = Blog::find($id);
        if($blog->user_id!=session('id')){
            return back();
        }
        Storage::delete($blog->image);
        $blog->delete();
        return redirect()->route('myblog'); 
    }
    
    public function dowrite(BlogRequest $req){
        $blog = new Blog;
        
        $blog->user_id = session('id');
        $blog->fill($req->all());

        if($req->hasFile('logo') && $req->logo->isValid())
        {
            $logo = $req->logo->store(date('Y-m-d'));
            $blog->image = $logo;
        }
        else{
            return back()->withInput()->withErrors(['logo'=>'图片上传失败']);
        }
        $dt = new DateTime;
        $blog->score=$dt->format('U');
        $blog->save();

        return redirect()->route('myblog'); 
    }
}
