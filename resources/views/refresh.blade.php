@extends('layout.layout')
 
@section('content');
    <main role="main" class="container">
      <div class="jumbotron">
        <h1>It's working !</h1>
        <p class="lead">Dites-nous en plus sur le vol d'aujho</p>
        <a class="btn btn-lg btn-primary" href="refresh" role="button">Refresh</a>
        <hr />
        <h1>Find your sqwak !</h1>
        <p class="lead">You can find the sqwuak for your departure here : </p>
        <a class="btn btn-lg btn-primary" href="/airports" role="button">Manage my airports</a>
      </div>
    </main>

@endsection