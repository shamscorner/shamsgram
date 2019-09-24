<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
    * author: shamscorner
    * DateTime: 13/May/2019 - 17:53:10
    *
    * return the corresponding user of this post
    *
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
