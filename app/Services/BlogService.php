<?php


namespace App\Services;


use App\Models\Post;
use App\Models\User;

class BlogService
{
    public function getAllPosts()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function createPost($data, $user_id)
    {
        Post::create([
            'title' => $data -> title,
            'post_content' => $data -> post_content ,
            'time' => $data -> time,
            'user_id' => $user_id
        ]);
        return true;
    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }

    public function filterByWriterDate($writer, $date)
    {
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
        return $posts;
    }


}
