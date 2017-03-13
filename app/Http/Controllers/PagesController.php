<?php

namespace App\Http\Controllers;
use App\Post;
class PagesController extends Controller {

	public function getIndex(){
		/* pegando apenas os ultimos 4 posts*/
		$posts = Post::orderBy('created_at', 'desc')->limit(3)->get();
    return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout(){
		return view('pages.about');
	}

	public function getContact(){
		return view('pages.contact');
	}

} 