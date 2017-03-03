@extends('layouts.main')
@section('title', '| Create new Post')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/parsley.css') }}">
@endsection
@section('content')

  {{-- Basta carregar os elementos com a ajuda o yield como mostrado acima, no caso, o css e o js abaixo
  no cabeçalho da form adicionar: data-parsley-validate e nos inputs que precisam ser preenchidos adicionar required
  isso vai fazer com que sejam feitas as validações pelo servidor 

  Podemmos tbm adicionar max length ou min atravez das constantes toda a documentação em:
  http://parsleyjs.org/doc/index.html --}}

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Create a New Post</h1>
      <hr>

      {{-- 
      {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

        {{ Form::label('body', "Post Body:") }}
        {{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '')) }}

        {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
      {!! Form::close() !!}
       --}}

      <form method="POST" action="{{ route('posts.store') }}" data-parsley-validate>
        <div class="form-group">
          <label name="title">Title:</label>
          <input id="title" name="title" required="" maxlength="255" class="form-control">
        </div>
        <div class="form-group">
          <label name="slug">Slug:</label>
          <input id="slug" name="slug" required="" minlength="5" maxlength="255" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="category_id">Category</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label name="body">Post Body:</label>
          <textarea id="body" name="body" rows="10" class="form-control" required=""></textarea>
        </div>

        <input type="submit" value="Create Post" class="btn btn-success btn-lg btn-block">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript" src="{{ asset('js/parsley.min.js') }}"></script>
@endsection