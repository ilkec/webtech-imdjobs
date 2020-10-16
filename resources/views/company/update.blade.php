@extends('partials.app')

@section('title')
    Complete company
@stop

@section('content')
   <form method="post" action=""  enctype="multipart/form-data">
        {{csrf_field()}}
        <h2>Add a company</h2>
        <div class="form-group">
            <label for="name">Company name</label>
            <input name="name" type="text" class="form-control" id="name" value="{{$foursquare->name}}">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" value="{{$foursquare->location->city}}">
        </div>

        <div class="form-group">
            <label for="province">Province</label>
            <input name="province" type="text" class="form-control" id="province" value="{{$foursquare->location->state}}" placeholder="Province">
        </div>
        <div class="form-group">
            <label for="street_address">Street address</label>
            <input name="street_address" type="text" class="form-control" id="street_address" value="{{$foursquare->location->address}}" placeholder="Street name">
        </div>
        <div class="form-group">
            <label for="postal_code">Postal code</label>
            <input name="postal_code" type="text" class="form-control" id="postal_code" value="{{$foursquare->location->postalCode}}" placeholder="Postal Code">
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" class="form-control" id="description">{{$foursquare->categories[0]->name}}</textarea>
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
        
        <button type="submit" class="btn btn-primary"> Update company</button>
    </form>
@endsection