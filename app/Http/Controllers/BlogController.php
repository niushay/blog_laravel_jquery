<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Models\Post;
use App\Models\User;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BlogController extends Controller
{
    private  $blogService;

    public function __construct(BlogService $blogService)
    {
        $this -> blogService = $blogService;
    }

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
        $posts = $this -> blogService -> getAllPosts();

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
        $this->blogService->createPost($request->all(), $user_id);

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
            $postData = $this->blogService->getPostById($id);

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

        $posts = $this->blogService->filterByWriterDate($writer, $date);

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
        return Excel::download(new PostsExport, 'posts.xlsx');
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
