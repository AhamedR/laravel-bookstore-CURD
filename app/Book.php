<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "tblbooks";

    public function user()
    {
        return $this->belongsTo('App\User','id','id');
    }

    public function catagory()
    {
        return $this->belongsTo('App\Catagory','id','id');

    }
}
