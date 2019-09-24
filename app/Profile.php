<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 18:12:44
    *
    * add a profile image
    *
    */
    public function profileImage()
    {
        $imagePath = ($this->image) ?  $this->image : 'profile/D0jjeTv76v6vHY5PuD6BRXAgEDDejSDL4wMCgCnn.png';

        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 21:24:31
    *
    * user profile has many followers
    *
    */
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
