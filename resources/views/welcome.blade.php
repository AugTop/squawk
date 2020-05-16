@extends('layout.layout')
 
@section('content');
    <main role="main" class="container">
      <div class="jumbotron">
        <h1>Welcome !</h1>
        <p class="lead">You can click here for fecth all the traffic online on ivao ...</p>
        <a class="btn btn-lg btn-primary" href="refresh" role="button">Refresh</a>
        <hr />
        <h1>Find your sqwak !</h1>
        <p class="lead">You can find the sqwuak for your departure here : </p>
        <a class="btn btn-lg btn-primary" href="../../components/navbar/" role="button">Find !</a>
      </div>
    </main>

@endsection