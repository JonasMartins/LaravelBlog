@extends('layouts.main')
@section('title', '| All Tags')

@section('content')

  <div class="row">
    <div class="col-md-8">
      <h1>Tags</h1>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
          </tr>
        </thead>
        
        <tbody>
          @foreach ($tags as $tag)
          <tr>
            <th>{{ $tag->id }}</th>
            <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
          </tr>
          @endforeach
        </tbody>
      
      </table>
    </div>{{-- end col.8 --}}
    <div class="col-md-3">
      <div class="well">
        <form method="POST" action="{{ route('tags.store') }}" data-parsley-validate>
          <h3>New Tag</h3>
          <div class="form-group">
            <label name="name">Name:</label>
            <input id="name" name="name" required="" maxlength="255" class="form-control">
          </div>

        <input type="submit" value="Create" class="btn btn-success btn-block">
        <input type="hidden" name="_token" value="{{ Session::token() }}">

        </form>
      </div>
    </div>
  </div>

@endsection