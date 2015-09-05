<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Post extends Model
{
    protected $fillable = ['slug', 'title', 'excerpt', 'content', 'published', 'published_at'];
    public function getsPublishedPost(){
        $posts = Post::latest('published_at')
            ->where('published','=','1')
            ->get();
        return $posts;
    }

    public function getPost($id){
        $post = Post::latest('id')->where('id','=',$id)->get();
        return $post;
    }

    public function getUpdate($id, $post){
        $post = Post::latest('id')
            ->where('id','=',$id)
            ->update(['slug'=>$post['slug'], 'title'=>$post['title'],'excerpt'=>$post['excerpt'],'content'=>$post['content'],'published'=>$post['published'],'published_at'=>$post['published_at']]);
        return $post;
    }
}
