<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $user_id = auth() -> user() -> id;
        $user = Post::findOrFail($user_id);

        $posts = $user -> posts;

        return response() -> json([
            'status' => 1,
            'message' => 'All posts',
            'data' => $posts
        ]);
    }

    public function create(Request $request)
    {
        dd($request->all());
        $user_id = auth() -> user() -> id;

        //Validation
        $request->validate([
            'title' => 'required' ,
            'post_content' => 'required',
            'time' => 'required',
        ]);

        //Create Book
        Post::create([
            'title' => $request -> title,
            'post_content' => $request -> post_content ,
            'photo_url'=> $request -> photo_url,
            'time' => $request -> time,
            'user_id' => $user_id
        ]);

        //Send response
        return response() -> json([
            'status' => 1,
            'message' => 'Post has been created successfully',
        ]);
    }

    public function postsList()
    {
        return view('posts.index');
    }

    public function createPost()
    {
        return view('posts.create');
    }
}
