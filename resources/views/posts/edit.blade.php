@extends('layouts.main')
@section('title', '| Edit Post')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/parsley.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
  {{-- tinymce editor --}}
  <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      /* Caso queria adicionar plugins onde podemos ver varias outras funcionalidades basta procurar na 
      documentação que pode ser encontrada no site*/
      plugins: 'link'
    });
  </script>
@endsection
@section('content')
  <div class="row">
    <form method="POST" action="{{ route('posts.update', $post->id) }}">
      <div class="col-md-8">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control input-lg" id="title" name="title" rows="1" style="resize:none;" value="{{ $post->title }}">
        </div>
        <div class="form-group">
          <label for="slug">Slug:</label>
          <input type="text" class="form-control input-lg" id="slug" name="slug" rows="1" style="resize:none;" value="{{ $post->slug }}">
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
          <label for="tags">Tags</label>
          <select class="form-control select2-multi" id="tags" name="tags[]" multiple="true">
            @foreach ($tags as $tag)
              <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                <button class="btn btn-success" data-toggle="tooltip" title="Save" 
                    data-placement="bottom">Save</button>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                  {{ method_field('PUT') }}
              </div>
              <div class="col-md-4 col-md-offset-2">
                <button class="btn btn-danger" data-toggle="tooltip" title="Cancel" 
                data-placement="bottom" onclick='location.href = "{{ route('posts.show', $post->id) }}";'>Cancel</button>
              </div>
            </div>{{-- end of row --}}
          </div>{{-- end of row --}}
        </div>
      </form>﻿        
    </div>
@endsection
@section('scripts')
  <script type="text/javascript" src="{{ asset('js/parsley.min.js') }}"></script>
  <script src="{{ asset('js/myscript.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
  <script type="text/javascript">
    $('.select2-multi').select2();
    $('.select2-multi').select2().val({{ json_encode($post->tags()->pluck('tag_id')->toArray()) }}).trigger('change');

  </script>
@endsection