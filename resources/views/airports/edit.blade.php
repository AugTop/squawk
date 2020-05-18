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
  <form action="/airports/{{ $airport->id }}/update" method="POST">
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
    <table class="table table-bordered" id="dynamic_field">
      @foreach($airport->code as $key => $code)
      @if ($key < 1)
      <tr>
        <td><input type="number" name="min[]" placeholder="Min sqwak mode" class="form-control name_list" value="{{ $code->min_value }}" max="9999" /></td>
        <td><input type="number" name="max[]" placeholder="Max sqwak code" class="form-control name_list" value="{{ $code->max_value }}" max="9999" /></td>
        <td><button type="button" name="add" id="add" class="btn btn-success">Add Range</button></td>
      </tr>
      @else
      <tr>
        <td><input type="number" name="min[]" placeholder="Min sqwak mode" class="form-control name_list" value="{{ $code->min_value }}" max="9999"/></td>
        <td><input type="number" name="max[]" placeholder="Max sqwak code" class="form-control name_list" value="{{ $code->max_value }}" max="9999"/></td>
        <td><button type="button" name="remove" class="btn btn-danger btn_remove">Remove</button></td>
      </tr>
      @endif
      @endforeach 
    </table>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Edit</button>
    </div>
  </form>
</main>
<script>
  $(document).ready(function() {
    var max_fields = 20; 
var wrapper = $("#dynamic_field"); //Fields wrapper
var add_button = $("#add"); //Add button ID

var x = 1; 
$(add_button).click(function(e){ 

  e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<tr><td><input type="number" name="min[]" placeholder="Min sqwak mode" class="form-control name_list" max="9999"/></td><td><input type="number" name="max[]" placeholder="Max sqwak code" class="form-control name_list" max="9999"/></td><td><button type="button" name="remove" class="btn btn-danger btn_remove">Remove</button></td></tr>'); //add input box
}
});

$(wrapper).on("click",".btn_remove", function(e){ //user click on remove field
  e.preventDefault(); $(this).closest('tr').remove(); x--;
})
});
</script>
@endsection