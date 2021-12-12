<?php


namespace App\Services;


use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BlogService
{
    public function getAllPosts()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->orderBy('created_at', 'desc')
            ->get();

        return $posts;
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
            $posts = DB::table('posts')
                ->join('users', function ($join) use ($date){
                    $join->on('posts.user_id', '=', 'users.id')
                        ->where('posts.created_at', 'like', $date . '%');
                })
                ->select('posts.*', 'users.name')
                ->orderBy('posts.created_at')
                ->get();
        }
        if($date == null && $writer != null) {
            $user = User::where('name', 'like', '%' . $writer . '%')->first();
            if($user) {
                $user_id = $user -> id;
                $posts = DB::table('posts')
                    ->join('users', function ($join) use ($user_id){
                        $join->on('posts.user_id', '=', 'users.id')
                            ->where('posts.user_id', $user_id);
                    })
                    ->select('posts.*', 'users.name')
                    ->orderBy('posts.created_at')
                    ->get();
            }
        }
        if($date !== null && $writer !== null){
            $user = User::where('name', 'like', '%' . $writer . '%')->first();
            if($user) {
                $user_id = $user -> id;

                $posts = DB::table('posts')
                    ->join('users', function ($join) use ($user_id, $date){
                        $join->on('posts.user_id', '=', 'users.id')
                            ->where('posts.user_id', $user_id)
                            ->where('posts.created_at', 'like', $date . '%');
                    })
                    ->select('posts.*', 'users.name')
                    ->orderBy('posts.created_at')
                    ->get();
            }
        }
        return $posts;
    }
}
