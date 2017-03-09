@extends('layouts.main')
@section('title', "| $tag->name Tag")
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <h2>Posts tagged with "{{ $tag->name }}"<small> ({{ $tag->posts()->count() }}) Posts</small></h2>
    </div>
    @if(Auth::check())
    <div class="col-md-2 col-md-offset-2">
      <form method="POST" action="{{ route('tags.destroy', $tag->id) }}">
        <button class="btn btn-danger">Delete Tag</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
         {{ method_field('DELETE') }}
    </div>
    @endif
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Tags</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tag->posts as $post)
          <tr>
            <td><a href="{{ route('posts.show', $post->id ) }}" class="btn btn-default btn-xs">{{$post->title}}</a></td>
            <td>@foreach ($post->tags as $tag)
                <span class="label label-default">{{ $tag->name }}</span>
              @endforeach
              </td>
            <td>----</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection