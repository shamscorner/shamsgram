<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomMail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 17:31:03
    *
    * the boot method
    *
    */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username
            ]);

            Mail::to($user->email)->send(new NewUserWelcomMail());
        });
    }

    /**
    * author: shamscorner
    * DateTime: 13/May/2019 - 17:02:54
    *
    * return the user's profile
    *
    */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
    * author: shamscorner
    * DateTime: 13/May/2019 - 17:39:51
    *
    * return user's posts
    *
    */
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 21:22:27
    *
    * user is following many profiles
    *
    */
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
}
