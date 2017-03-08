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
    <div class="col-md-2 col-md-offset-2">
      <form method="POST" action="{{ route('tags.destroy', $tag->id) }}">
        {{-- <input type="submit" value="Delete" class="btn btn-danger btn-circle btn-lg"> --}}
        <button class="btn btn-danger" data-toggle="tooltip" title="Delete Tag" 
              data-placement="bottom"><i class="fa fa-times" aria-hidden="true"></i></button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
         {{ method_field('DELETE') }}
    </div>
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
  {{-- font awesome --}}
  <script src="https://use.fontawesome.com/7a9bd1ec22.js"></script>
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection