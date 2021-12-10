<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Client\Curl\User;
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
        $user_id = auth() -> user() -> id;

        //Validation
        $request->validate([
            'title' => 'required',
            'post_content' => 'required',
            'time' => 'required',
        ]);

        //Create Post
        Post::create([
            'title' => $request -> title,
            'post_content' => $request -> post_content ,
            'time' => $request -> time,
            'user_id' => $user_id
        ]);

        //Send response
        return response() -> json([
            'status' => 1,
            'message' => 'Post has been created successfully',
        ]);
    }

    public function singlePost($id)
    {
        if(Post::where([
            'id' => $id,
        ])->exists()){
            $postData = Post::findOrFail($id);

            return response() -> json([
                'status' => 1,
                'message' => 'Single post details',
                'data' => $postData
            ]);
        }

        return response() -> json([
            'status' => 0,
            'message' => 'Post not Found',
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
