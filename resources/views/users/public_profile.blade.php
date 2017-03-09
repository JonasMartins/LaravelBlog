@extends('layouts.main')
@section('title', '| Profile')
@section('content')
 <h1>{{$user->name}} Profile</h1> 
 <hr>
 <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <th>Profile</th>
          </thead>
            <tbody>
            <tr>
              <th scope="row">Email</th>
              <td>{{$user->email}}</td>
            </tr>
            <tr>
              <th scope="row">date birth</th>
              <td>*******</td>
            </tr>
            <tr>
              <th scope="row">phone</th>
              <td>*******</td>
            </tr>
            <tr>
              <th scope="row">bio</th>
              <td>*******</td>
            </tr>
            <tr>
              <th scope="row">level</th>
              <td>*******</td>
            </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>{{-- end row --}}
@endsection
