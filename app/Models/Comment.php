<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['blog_id','content'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
