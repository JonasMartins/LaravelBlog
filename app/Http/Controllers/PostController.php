<?php

namespace App\Http\Controllers;


use Session;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      /**
       * get current user
       * @var $user
       */
      $user = Auth::user();
      $posts = $user->posts()->orderBy('id','desc')->paginate(5);
      return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $categories = Category::all();
      return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      $this->validate($request, [
        'title'       => 'required|max:255',
        'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'category_id' => 'required|integer',
        'body'        => 'required'
      ]);
      /* Se passar daqui as validações forama compridas não precisa de if elses ??...*/
      $post = new Post;
      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->category_id = $request->category_id;
      $post->body = $request->body;

      $request->user()->posts()->save($post);

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
      $categories = Category::all();
      return view('posts.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

      $post = Post::find($id);  
      if( $request->input('slug') == $post->slug){
        $this->validate($request, [
        'title' => 'required|max:255',
        'category_id' => 'required|integer',
        'body' => 'required'
      ]);  
      } else {      
      $this->validate($request, [
        'title' => 'required|max:255',
        'slug' => 'bail|alpha_dash|min:5|max:255|unique:posts,slug',
        'category_id' => 'required|integer',
        'body' => 'required'
        ]);
       }
      $post->title = $request->input('title');
      $post->slug = $request->input('slug');
      $post->category_id = $request->category_id;
      $post->body = $request->input('body');
      $post->update();
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
