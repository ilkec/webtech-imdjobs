@extends('partials.app')

@section('title')
    Add a company
@stop

@section('content')
   <!--<form method="post" action="">    //CHANGE FORM TO OTHER INFO? MAYBE KEEP NAME AND CITY BUT AUTO FILL
        {{csrf_field()}}
        <h2>Add a company</h2>
        <div class="form-group">
            <label for="name">Company name</label>
            <input type="name" class="form-control" id="name" placeholder="Company name">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="city" class="form-control" id="city" placeholder="City">
        </div>
        
        <button type="submit" class="btn btn-primary"> Add company</button>
    </form>-->
@endsection