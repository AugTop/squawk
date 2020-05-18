@extends('layout.layout')

@section('content');
<style type="text/css"></style>
<main role="main" class="container">
  <div class="jumbotron">
    <h1>My airports</h1>
    <p class="lead">Here you can manage your airports</p>
    <a class="btn btn-lg btn-primary" href="/airports/add" role="button">Add an airport</a> 
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table table-bordered table-responsive-md table-striped text-center">
    <thead>
      <tr>
        <th class="text-center">Airport Name</th>
        <th class="text-center">OACI code</th>
    </tr>
</thead>
<tbody>
@foreach ($airports as $airport)
    <tr>
        <td class="pt-4-half">{{ $airport->name }}</td>
        <td class="pt-4-half">{{ $airport->oaci }}</td>
        <td>
          <span class="table-remove"><a href="airports/{{ $airport->id }}/edit"><button type="button"
              class="btn btn-success btn-rounded btn-sm my-0">Edit</button></a></span>
          </td>
          <td>
              <span class="table-remove"><a href="/airports/{{ $airport->id }}/delete"><button type="button"
                  class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></a></span>
              </td>

          </tr>
          @endforeach
      </tbody>
  </table>

</main>

@endsection