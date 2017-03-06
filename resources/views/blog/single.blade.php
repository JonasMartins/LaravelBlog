@extends('layouts.main')
@section('title', "| $post->title" )
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{ $post->title}}</h1>
      <br>
      <div class="tags">Tags:
        @foreach($post->tags as $tag)
          <span class="label label-default">{{$tag->name}}</span>
        @endforeach
      </div>
      <hr>
      <p>{{ $post->body}}</p>
    </div>
  </div>
@endsection
