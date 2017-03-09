<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller{

  public function getIndex(){
    $posts = Post::paginate(5);
    return view('blog.index')->withPosts($posts);
  }

  public function getSingle($slug){
    /* cada slug é unico*/
    $post = Post::where('slug', '=', $slug)->first();
    $author = User::find($post->user_id);
    return view('blog.single')->withPost($post)->with(['author' => $author]);
  }

}
