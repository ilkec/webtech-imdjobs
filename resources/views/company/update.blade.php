@extends('partials.app')

@section('title')
    Add a company
@stop

@section('content')
   <form method="post" action=""  enctype="multipart/form-data">
        {{csrf_field()}}
        <h2>Add a company</h2>
        <div class="form-group">
            <label for="name">Company name</label>
            <input name="name" type="text" class="form-control" id="name" value="{{$company->name}}">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" value="{{$company->city}}">
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <input name="description" type="text" class="form-control" id="description" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="picture">logo</label>
            <input name="picture" type="file" class="form-control" id="picture" accept="image/*" placeholder="Company Logo">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Company email">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Company phone number">
        </div>
        <div class="form-group">
            <label for="province">Province</label>
            <input name="province" type="text" class="form-control" id="province" placeholder="Province">
        </div>
        <div class="form-group">
            <label for="street_name">Street name</label>
            <input name="street_name" type="text" class="form-control" id="street_name" placeholder="Street name">
        </div>
        <div class="form-group">
            <label for="street_number">Street number</label>
            <input name="street_number" type="number" class="form-control" id="street_number" placeholder="Street number">
        </div>
        <div class="form-group">
            <label for="postal_code">Postal code</label>
            <input name="postal_code" type="text" class="form-control" id="postal_code" placeholder="Postal code">
        </div>
        
        <button type="submit" class="btn btn-primary"> Add company</button>
    </form>
@endsection