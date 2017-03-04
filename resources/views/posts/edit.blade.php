@extends('layouts.main')
@section('title', '| Edit Post')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/parsley.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
  <div class="row">
    <form method="POST" action="{{ route('posts.update', $post->id) }}">
      <div class="col-md-8">
        <div class="form-group">
          <label for="title">Title:</label>
          <textarea type="text" class="form-control input-lg" id="title" name="title" rows="1" style="resize:none;">{{ $post->title }}</textarea>
        </div>
        <div class="form-group">
          <label for="slug">Slug:</label>
          <textarea type="text" class="form-control input-lg" id="slug" name="slug" rows="1" style="resize:none;">{{ $post->slug }}</textarea>
        </div>
        
        <div class="form-group">
          <label for="category_id">Category</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($categories as $category){{-- adicionar selected apenas com javascript --}}
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="body">Body:</label>
          <textarea type="text" class="form-control input-lg" id="body" name="body" rows="10">{{ $post->body }}</textarea>
        </div>
      </div>
      <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <dt>Created at:</dt>
            <dd>{{ date('M j, Y h:i:sa', strtotime($post->created_at)) }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Last updated:</dt>
            <dd>{{ date('M j, Y h:i:sa', strtotime($post->updated_at)) }}</dd>
          </dl>
          <hr>
            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <button class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" title="Save" 
                    data-placement="bottom"><i class="fa fa-check" aria-hidden="true"></i></button>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                  {{ method_field('PUT') }}
              </div>
              <div class="col-md-4 col-md-offset-2">
                <button class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" title="Cancel" 
                data-placement="bottom" onclick='location.href = "{{ route('posts.show', $post->id) }}";'><i class="fa fa-times" aria-hidden="true"></i></button>
              </div>
            </div>{{-- end of row --}}
          </div>{{-- end of row --}}
        </div>
      </form>﻿        
    </div>
    
    
      


@endsection
@section('scripts')
  <script type="text/javascript" src="{{ asset('js/parsley.min.js') }}"></script>
  {{-- font awesome --}}
  <script src="https://use.fontawesome.com/7a9bd1ec22.js"></script>
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
@endsection