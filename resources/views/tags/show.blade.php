@extends('layouts.main')

@section('title', "| $tag->name Tag")

@section('content')

  <div class="row">
    <div class="col-md-8">
      <h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
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