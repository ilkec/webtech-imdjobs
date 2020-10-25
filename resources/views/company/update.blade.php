@extends('partials.app')

@section('title')
    Complete company
@stop

@section('content')
   <form method="post" action=""  enctype="multipart/form-data">
        {{csrf_field()}}
        <h2>Add a company</h2>

        @if( $errors->any())
        @component('components/alert')
            @slot('type') danger @endslot
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endcomponent
        @endif
        @if($flash = session('noCompany'))
            <div class="alert alert-danger"> {{ $flash }} </div>
        @endif

        <div class="form-group">
            <label for="name">Company name</label>
            <input name="name" type="text" class="form-control" id="name" value="@if(!empty($foursquare['name'])) {{$foursquare['name']}} @else {{$company->name}} @endif" placeholder="Company name">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" value="@if(!empty($foursquare['location']['city'])) {{$foursquare['location']['city']}} @else {{$company->city}} @endif" placeholder="City">
        </div>

        <div class="form-group">
            <label for="province">Province</label>
            <input name="province" type="text" class="form-control" id="province" value="@if(!empty(old('province'))) {{old('province')}}  @elseif(!empty($foursquare['location']['state'])) {{$foursquare['location']['state']}} @endif" placeholder="Province">
        </div>
        <div class="form-group">
            <label for="street_address">Street address</label>
            <input name="street_address" type="text" class="form-control" id="street_address" value="@if(!empty(old('street_address'))) {{old('street_address')}} @elseif(!empty($foursquare['location']['address'])) {{$foursquare['location']['address']}} @endif" placeholder="Street name">
        </div>
        <div class="form-group">
            <label for="postal_code">Postal code</label>
            <input name="postal_code" type="text" class="form-control" id="postal_code" value="@if(!empty(old('postal_code'))) {{old('postal_code')}} @elseif(!empty($foursquare['location']['postalCode'])) {{$foursquare['location']['postalCode']}} @endif" placeholder="Postal Code">
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" class="form-control" id="description">@if(!empty(old('description'))) {{old('description')}} @elseif(!empty($foursquare['categories'][0]['name'])) {{$foursquare['categories'][0]['name']}} @endif</textarea>
        </div>
        <div class="form_group">
            <input type="file" name="image" class="btn mb-3" id="image" accept="image/*">
            <label for="image" class="btn">Choose a file</label>
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input name="email" type="email" class="form-control" id="email" value="@if(!empty(old('email'))) {{old('email')}} @endif" placeholder="Company email">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input name="phone_number" type="tel" class="form-control" id="phone_number" value="@if(!empty(old('phone_number'))) {{old('phone_number')}} @endif" placeholder="Company phone number">
        </div>
        
        <button type="submit" class="btn btn-primary"> Update company</button>
    </form>
@endsection