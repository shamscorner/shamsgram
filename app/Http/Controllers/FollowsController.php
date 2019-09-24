<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 21:55:09
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 20:58:42
    *
    * follow a specific user
    *
    */
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
