@extends('layouts.main')   
{{--  Extende do layout main e aseção content é colocada dentro do content em main --}}
@section('title', '| Homepage')
@section('content')
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          {{-- <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Create an My Blog! Account and share your posts worldwide! 
            </p>
            @if (Auth::guest())
              <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
            @endif
          </div> --}}
          <div class="carousel slide" id="home-carousel">
           <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#home-carousel" data-slide-to="1"></li>
              <li data-target="#home-carousel" data-slide-to="2"></li>
              <li data-target="#home-carousel" data-slide-to="3"></li>
              <li data-target="#home-carousel" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="{{ URL::asset('/images/ruby.jpg') }}">
                <div class="carousel-caption">
                  <h3>This is a Caption Description</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
              </div>
              <div class="item">
                <img src="{{ URL::asset('/images/angularjs.jpg') }}">
              </div>
              <div class="item">
                <img src="{{ URL::asset('/images/php.jpg') }}">
              </div>
              <div class="item">
                <img src="{{ URL::asset('/images/vuejs.png') }}">
              </div>
              <div class="item">
                <img src="{{ URL::asset('/images/laravel.jpg') }}">
              </div>
            </div>{{-- carousel-inner --}}
            <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
               <span class="sr-only">Next</span>
            </a>
            

          </div>{{-- carousel --}}
        </div>
      </div>
      <!-- end of header .row -->

      <div class="row">
        <div class="col-md-6 col-md-offset-1">
        <h2>Latest Posts</h2>
        <hr>
        @foreach($posts as $post)

          <div class="post">
            <h3>{{$post->title}}</h3>
            {{-- strip_tags para tirar a marcação html --}}
            <p>{{ substr( strip_tags($post->body), 0, 300)}}{{ strlen(strip_tags($post->body)) > 300 ? " ...":""}}</p>
            <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
          </div>

          <hr>

        @endforeach

        </div>

        <div class="col-md-2 col-md-offset-1">
          <h2>Announcements</h2>
          <hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(function() {
      $('.carousel').carousel({
        interval: 4000,
      });
    });
  </script>
@endsection