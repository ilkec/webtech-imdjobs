@extends('partials.app')

@section('title')
    Add a company
@stop

@section('content')
   <form method="post" action="">
        {{csrf_field()}}
        <h2>Add a company</h2>
        <div class="form-group">
            <label for="name">Company name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Company name">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" placeholder="City">
        </div>
        
        <button type="submit" class="btn btn-primary">Add company</button>
    </form>
@endsection