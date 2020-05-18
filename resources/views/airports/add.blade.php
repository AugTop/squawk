@extends('layout.layout')

@section('content')
<main role="main" class="container">
  <div class="jumbotron">
    <h1>Add airport</h1>
    <p class="lead">Here you can add your airport</p>
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
  <form action="add" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Airport name</label>
      <input type="text" class="form-control" name="name" placeholder="Paris De Gaulle" required="">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Airport OACI code</label>
      <input type="text" name="oaci" placeholder="LFPG" maxlength="4" required="" class="form-control">
    </div>
    <label>Squawk code(s)</label>
    <table class="table table-bordered" id="dynamic_field">
      <tr>
        <td><input type="number" name="min[]" placeholder="Min squawk mode" class="form-control name_list" /></td>
        <td><input type="number" name="max[]" placeholder="Max sqawk code" class="form-control name_list" /></td>
        <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
      </tr>
    </table>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </form>
</main>


<script>
  $(document).ready(function(){
    var i=0;
    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="min[]" placeholder="Min squawk mode" class="form-control name_list"/></td><td><input type="number" name="max[]" placeholder="Max squawk code" class="form-control name_list"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id"); 
      $('#row'+button_id+'').remove();
    });

  });
</script>

@endsection