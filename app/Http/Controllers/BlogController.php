<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BlogController extends Controller
{
    public function getUserName()
    {
        $user = auth()->user();
        $user_name = $user->name;

        return response() -> json([
            'status' => 1,
            'message' => 'Username',
            'user_name' => $user_name
        ]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();


        return response() -> json([
            'status' => 1,
            'message' => 'All posts',
            'data' => $posts,
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
                'data' => $postData,
                'post_id' => $id
            ]);
        }

        return response() -> json([
            'status' => 0,
            'message' => 'Post not Found',
        ]);
    }

    public function filter(Request $request)
    {
        $posts = [];
        $writer = $request -> writer;
        $date = $request -> date;

        if($writer == null && $date != null){
            $posts = Post::where('created_at', 'like', $date . '%')->get();
        }
        if($date == null && $writer != null) {
            $user = User::where('name', 'like', '%' . $writer . '%')->first();
            if($user) {
                $user_id = $user -> id;
                $posts = Post::where('user_id', $user_id)->get();
            }
        }
        if($date !== null && $writer !== null){
            $user = User::where('name', 'like', '%' . $writer . '%')->first();
            if($user) {
                $user_id = $user -> id;
                $posts = Post::where(function ($query) use($user_id, $date) {
                $query->where('user_id',  $user_id)
                    ->where('created_at', 'like', $date . '%');
                })->get();
            }
        }

        if(sizeof($posts) == 0) {
            return response() -> json([
                'status' => 0,
                'message' => 'Post not found!',
            ]);
        }

        return response() -> json([
            'status' => 1,
            'message' => 'All filtered Posts',
            'data' => $posts
        ]);
    }

    public function excelExport()
    {
        $user_id = auth() -> user() -> id;
        Excel::download(new PostsExport, 'posts.xlsx');
    }

    public function postsList()
    {
        return view('posts.index');
    }

    public function createPost()
    {
        return view('posts.create');
    }

    public function singlePostView($id)
    {
        return view('posts.single', compact('id'));
    }

}
