@extends('partials.app')

@section('title')
    Edit company
@stop

@section('content')
   <form method="post" action=""  enctype="multipart/form-data">
        {{csrf_field()}}
        <h2>Edit your company</h2>
        <h4>All fields are required</h4>
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
            <label for="name">Company name *</label>
            <input name="name" type="text" class="form-control" id="name" value="{{$company->name}}" placeholder="Company name">
        </div>
        <div class="form-group">
            <label for="city">City *</label>
            <input name="city" type="text" class="form-control" id="city" value="{{$company->city}}" placeholder="City">
        </div>

        <div class="form-group">
            <label for="province">Province *</label>
            <input name="province" type="text" class="form-control" id="province" value="{{$company->province}}" placeholder="Province">
        </div>
        <div class="form-group">
            <label for="street_address">Street address *</label>
            <input name="street_address" type="text" class="form-control" id="street_address" value="{{$company->street_address}}" placeholder="Street name">
        </div>
        <div class="form-group">
            <label for="postal_code">Postal code *</label>
            <input name="postal_code" type="text" class="form-control" id="postal_code" value="{{$company->postal_code}}" placeholder="Postal Code">
        </div>

        <div class="form-group">
            <label for="description">description *</label>
            <textarea name="description" class="form-control" id="description">{{$company->description}}</textarea>
        </div>
        <div class="form_group">
            <input type="file" name="image" class="btn mb-3" id="image" accept="image/*">
        </div>
        <div class="form-group">
            <label for="email">email *</label>
            <input name="email" type="email" class="form-control" id="email" value="{{$company->email}}" placeholder="Company email">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number *</label>
            <input name="phone_number" type="tel" class="form-control" id="phone_number" value="{{$company->phone_number}}" placeholder="Company phone number">
        </div>
        <div class="form-group">
            <label for="website">website *</label>
            <input name="website" type="text" class="form-control" id="website" value="{{$company->website}}" placeholder="Website">
        </div>
        
        <button type="submit" class="btn btn-primary"> Update company</button>
    </form>
@endsection