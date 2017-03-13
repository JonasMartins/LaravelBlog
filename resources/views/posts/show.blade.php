@extends('layouts.main')
@section('title', '| View Post')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <h1>{{ $post->title }}</h1>
      <div class="tags">Tags:
        @foreach($post->tags as $tag)
          <span class="label label-default"><a href="{{ route('tags.show', $tag->id) }}">{{$tag->name}}</a></span>
        @endforeach
      </div>
      <hr>
      <small><i>Written By: <a href="{{ route('user.profile', $author->id) }}">{{$author->name}}</a></i></small>
      @if($post->image)
        <img src="{{ asset('images/posts/' . $post->image) }}" height="300" width="720" />
      @endif
      <p class="lead">{!! $post->body !!}</p>
    </div>

    <div class="col-md-4">
      <div class="well">
        <dl class="dl-horizontal">
          <label>Url Slug:</label>
          <p><a href="{{ url('blog/'.$post->slug) }}">{{ $post->slug }}</a></p>
        </dl>
        <dl class="dl-horizontal">
          <label>Category:</label>
          <p>{{$post->category->name}}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Created At:</label>
          <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
        </dl>

        <dl class="dl-horizontal">
          <label>Last Updated:</label>
          <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
        </dl>
        <hr>

        @if ($current_user == $author )
          <div class="row">
            <div class="col-sm-4">
            {{-- {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!} --}}
              <button class="btn btn-default" data-toggle="tooltip" title="My Posts" 
                    data-placement="bottom" onclick='location.href = "{{ route('posts.index') }}";'>Posts</button>
            </div>
            <div class="col-sm-4">
            {{-- {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!} --}}
              <button class="btn btn-warning" data-toggle="tooltip" title="Edit Post" 
                    data-placement="bottom" onclick='location.href = "{{ route('posts.edit', $post->id) }}";'>Edit</button>
            </div>
            <div class="col-sm-4">
            {{-- {!! Html::linkRoute('posts.destroy', 'Delete', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
             <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger btn-block">Delete</a>
            
            Com ação:

              <div class="col-sm-6">
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

                {!! Form::close() !!}
              </div>
            --}}
             <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
              {{-- <input type="submit" value="Delete" class="btn btn-danger btn-circle btn-lg"> --}}
              <button class="btn btn-danger" data-toggle="tooltip" title="Delete Post" 
                    data-placement="bottom">Delete</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
               {{ method_field('DELETE') }}
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
@section('scripts')
   <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection