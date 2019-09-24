<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 01:26:41
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 22:19:55
    *
    * show all the posts of the user
    *
    */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
    * author: shamscorner
    * DateTime: 13/May/2019 - 18:04:25
    *
    * create a post
    *
    */
    public function create()
    {
        return view('posts.create');
    }

    /**
    * author: shamscorner
    * DateTime: 13/May/2019 - 22:49:16
    *
    * add a new post
    *
    */
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    /**
    * Author: shamscorner
    * DateTime: 14/May/2019 - 02:27:26
    *
    * show a post
    *
    * @param Integer $post
    *
    */
    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        return view('posts.show', compact('post', 'follows'));
    }
}
