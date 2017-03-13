<?php

namespace App\Http\Controllers;


use Session;
use Purifier;
use Image;

use App\Tag;
use App\Post;
use App\User;
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
      $tags = Tag::all(); 
      return view('posts.create')->withCategories($categories)->withTags($tags);
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
      /* Alterando as configurações de segurança dos posts 
      $post->body = Purifier::clean($request->body, 'youtube');*/
      $post->body = Purifier::clean($request->body);
      /* images upload */
      if ($request->hasFile('featured_image')){
        $image = $request->file('featured_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/posts/' . $filename);

        /**
         * Biblioteca usada para fazer upload das imagens da forma correta:
         * http://image.intervention.io
         * 
         * atamanho padrão de imagens com a resolução ideal para aparecer no carousel 
         * @param $image: Imagem a ser salva que foi devidamente gerada acima.
         * @param $location: Local onde a image deve ser salva, notat que na pasta public podemos
         * vê-la pela url 
         */
        Image::make($image)->resize(720, 300)->save($location);
        $post->image = $filename;
      }




      $request->user()->posts()->save($post);
      /* false impede que se sobrescreva as relações anteriores.
      sync é a função exata para poder usar o many to many simples assim, onde
      passamos o array de elementos que queremos passar na criação do novo post.*/
      $post->tags()->sync($request->tags, false);


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
      $current_user = null;
      $post = Post::find($id);
      $author = User::find($post->user_id);
      if (Auth::check()){
        $current_user = Auth::user();
      }
      return view('posts.show')->withPost($post)->with(['current_user' => $current_user, 'author' => $author]);
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
      $tags = Tag::all(); 
      return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
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
      $post->body = Purifier::clean($request->input('body'));
      $post->update();
      /* evitar erro de apagar todas as tags na hora da edição */
      if (isset($request->tags)) {
        $post->tags()->sync($request->tags, true);
      } else {
        $post->tags()->sync(array());
      }

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
      /* eliminar referencias as tags referentes a esse post apos a remoção dele */
      $post->tags()->detach();

      $post->delete();
      Session::flash('success', 'Post Deleted!');
      return redirect()->route('posts.index');
    }
}
