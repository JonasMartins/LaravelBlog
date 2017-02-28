<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      $this->validate($request, [
        'title' => 'required|max:255',
        'body' => 'required'
      ]);
      /* Se passar daqui as validações forama compridas não precisa de if elses ??...*/
      $post = new Post;
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      Session::flash('success', 'Post Save!');
      return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      $post = Post::find($id);
      return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      $post = Post::find($id);
      return view('posts.edit')->withPost($post); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
       $this->validate($request, [
        'title' => 'required|max:255',
        'body' => 'required'
      ]);
      $post = Post::find($id);  
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();
      Session::flash('success', 'Post Updated!');
      return redirect()->route('posts.show', $post->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $post = Post::find($id);
      $post->delete();
      Session::flash('success', 'Post Deleted!');
      return redirect()->route('posts.index');
    }
}
