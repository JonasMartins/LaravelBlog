@extends('layouts.main')   
{{--  Extende do layout main e aseção content é colocada dentro do content em main --}}
@section('title', '| Homepage')
@section('content')
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Create an My Blog! Account and share your posts worldwide! 
            </p>

            @if (Auth::guest())
              <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
            @endif
          </div>
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-6 col-md-offset-1">
        @foreach($posts as $post)

          <div class="post">
            <h3>{{$post->title}}</h3>
            <p>{{ substr($post->body, 0, 300)}}{{ strlen($post->body) > 300 ? " ...":""}}</p>
            <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
          </div>

          <hr>

          @endforeach

        </div>

        <div class="col-md-2 col-md-offset-1">
          <h2>Sidebar</h2>
        </div>
      </div>
@endsection