<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $table ="slide";

    //do bảng slide ko liên bảng nào nên ko cần các liên kết models
}
