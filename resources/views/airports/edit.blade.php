@extends('layout.layout')

@section('content');
<style type="text/css"></style>
<main role="main" class="container">
  <div class="jumbotron">
    <h1>Edit airport</h1>
    <p class="lead">Here you can edit your airport</p>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/airports/{{ $airport->id }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="form-group">
    <label for="exampleFormControlInput1">Aiport name</label>
    <input type="text" class="form-control" name="name" placeholder="Paris De Gaulle" value="{{ $airport->name }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Airport OACI code</label>
    <input type="text" name="oaci" placeholder="LFPG" maxlength="4" required="" class="form-control" value="{{ $airport->oaci }}">
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Edit</button>
  </div>
</form>
</main>

@endsection