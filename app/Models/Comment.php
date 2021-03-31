<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table ="comment";

    public function tintuc(){
    	return $this->belongsto('App\Models\TinTuc','idTinTuc','id');
    }

    public function user(){
    	return $this->belongsto('App\Models\User','idUser','id');
    }
}
