@extends('layouts.main')
@section('title', '| All Posts')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <h1>My Posts</h1>
    </div>
    <div class="col-md-2 col-md-offset-2"> 
       <button class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" title="Create New Post" data-placement="bottom"
       onclick='location.href = "{{ route('posts.create') }}";'><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div> <!-- end of .row -->

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            {{-- <th>#</th> --}}
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th></th>
          </thead>
            <tbody>
            @foreach ($posts as $post)
              <tr>
                {{-- <th>{{ $post->id }}</th> --}}
                <td><h4>{{ $post->title }}</h4></td>
                <td><h4>{{ substr($post->body, 0, 40) }}{{ strlen($post->body) > 50 ? "..." : "" }}</h4></td>
                <td><h4>{{ date('M j, Y', strtotime($post->created_at)) }}</h4></td>
                <td>
                  <button class="btn btn-default btn-circle" data-toggle="tooltip" title="View Post" 
                  data-placement="bottom" onclick='location.href = "{{ route('posts.show', $post->id) }}";'><i class="fa fa-eye" aria-hidden="true"></i></button>
                  <button class="btn btn-primary btn-circle" data-toggle="tooltip" title="Edit Post" 
                  data-placement="bottom" onclick='location.href = "{{ route('posts.edit', $post->id) }}";'><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  <button class="btn btn-danger btn-circle" data-toggle="tooltip" title="Delete Post" 
                  data-placement="bottom" onclick='location.href = "{{ route('posts.show', $post->id) }}";'><i class="fa fa-times" aria-hidden="true"></i></button>
                  {{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a> <a href="#" class="btn btn-danger btn-sm">Delete
                  </a> --}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="text-center">
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  {{-- font awesome --}}
  <script src="https://use.fontawesome.com/7a9bd1ec22.js"></script>
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection