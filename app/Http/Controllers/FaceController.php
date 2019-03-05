<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FaceRequest;
use App\Models\User;
use Image;
use Storage;
class FaceController extends Controller
{
    public function face(){
        $id = session('id');
        $data = User::find($id);
        if($id!=$data->id){
            return back();
        }
        return view('face.face',['data'=>$data]);
    }
    public function upface(FaceRequest $req){

        if($req->hasFile('face') && $req->face->isValid())
        {   
            $oldimage = $req->face->path();
            $date = date('Y-m-d');
            $oriImg = $req->face->store('face/'.$date);
            $img = Image::make($oldimage);
            $img->crop((int)$req->w,(int)$req->h,(int)$req->x,(int)$req->y);

            $bgname = str_replace('face/'.$date.'/', 'face/'.$date.'/bg_', $oriImg);
            $img->resize(240,240);
            $img->save('uploads/'.$bgname);

            $mdname = str_replace('face/'.$date.'/', 'face/'.$date.'/md_', $oriImg);
            $img->resize(80,80);
            $img->save('uploads/'.$mdname);

            $smname = str_replace('face/'.$date.'/', 'face/'.$date.'/sm_', $oriImg);
            $img->resize(35,35);
            $img->save('uploads/'.$smname);

            $user = User::find(session('id'));

            Storage::delete( $user->face);
            Storage::delete( $user->bgface);
            Storage::delete( $user->mdface);
            Storage::delete( $user->smface);

            $user->face= $oriImg;
            $user->bgface= $bgname;
            $user->mdface= $mdname;
            $user->smface= $smname;
            $user->save();

            session([
                'smface'=>$smname,
                'bgface'=>$bgname,
            ]);
            return redirect()->route('face'); 
            // return $oriImg;
        }
        
    }
}
