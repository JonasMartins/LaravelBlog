@extends('layouts.main')
@section('title', "| $post->title" )
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{ $post->title}}</h1>
      <div class="tags">Tags:
        @foreach($post->tags as $tag)
          <span class="label label-default"><a href="{{ route('tags.show', $tag->id) }}">{{$tag->name}}</a></span>
        @endforeach
      </div>
      <hr>
      <small><i>Written By: <a href="{{ route('user.profile', $author->id) }}">{{$author->name}}</a></i></small>
      <p>{{ $post->body}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-2">
      <button id="comments-button" class="btn btn-default">Comments</button>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <section id="comments-section">      
        <hr>
        {{-- renderizar os comentarios relacionado aquele post --}}
      </section>
      @if (Auth::check())  
        {{-- <form method="POST" action="{{route('')}}">
          
        </form> --}}
      @endif
    </div>
  </div>
@endsection
@section('scripts')
  {{-- font awesome --}}
  <script src="https://use.fontawesome.com/7a9bd1ec22.js"></script>
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection