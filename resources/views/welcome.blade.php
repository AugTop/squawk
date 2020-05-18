@extends('layout.layout')

@section('content')
<main role="main" class="container">
  <div class="jumbotron">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <h1>Welcome !</h1>
    <p class="lead">You can click here for fecth all the traffic online on ivao ...</p>
    <a class="btn btn-lg btn-primary" href="refresh" role="button">Refresh</a>
    <hr />
    <h1>Find your sqwak !</h1>
    <p class="lead">You can find the sqwuak for your departure here : </p>
    <a class="btn btn-lg btn-primary" href="/airports" role="button">Manage my airports</a>
    <hr>
    <h1>Find your sqwak !</h1>
    <p class="lead">Entry your callsign here : </p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  <form method="POST" action="/squawk/find" class="form-group">
     @csrf
     <input type="text" name="callsign" class="form-control" placeholder="AFR2604" required=""><br/>
     <button class="btn btn-lg btn-primary form-control" type="submit">Find !</button>
 </form>
</div>
</main>

@endsection