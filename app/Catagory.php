<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $table = "tblcatagories";

    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
