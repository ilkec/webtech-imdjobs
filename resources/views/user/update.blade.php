@extends('partials.app')

@section('title')
    Profile
@stop

@section('content')
    <h1>Profile</h1>
    <div class="container-profile">
        <div class="container-profile">
        <h4>All fields are required</h4>
            <form action="" method="post">
                @csrf

                @if( $errors->any() )
                    @component('components/alert')
                        @slot('type', 'danger')
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>   
                    @endcomponent
                @endif


                <div class="form_group">
                    <label for="firstname">Firstname *</label>
                    <input value="{{ $users->first_name }}" class="form-control" type="text" name="firstname" id="firstname"  placeholder="Enter your first name">
                </div>
                <div class="form_group">
                    <label for="lastname">Lastname *</label>
                    <input value="{{ $users->last_name }}" class="form-control" type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <input value="{{ $users->description }}" type="input" name="description" class="form-control" id="description" placeholder="description">
                </div>

                <div class="form_group">
                    <label for="phonenumber">Phonenumber *</label>
                    <input value="{{ $users->phone_number }}" class="form-control" type="text" name="phonenumber" id="phonenumber"  placeholder="Enter your phonenumber">
                </div>

                <div class="form-group">
                    <label for="city">City *</label>
                    <input value="{{ $users->city }}" type="input" name="city" class="form-control" id="city" placeholder="City">
                </div>

                <div class="form_group">
                    <label for="linkedin">Linkedin profile</label>
                    <input value="{{ $users->linkedin }}" class="form-control" type="url" name="linkedin" id="linkedin"  placeholder="Enter the link to your linkedin account">
                </div>
                <div class="form_group">
                    <label for="dribbble">Dribbble profile</label>
                    <input value="{{ $users->dribbble }}" class="form-control" type="url" name="dribbble" id="dribbble"  placeholder="Enter the link to your dribbble account">
                </div>
                <div class="form_group">
                    <label for="behance">Behance profile</label>
                    <input value="{{ $users->behance }}" class="form-control" type="url" name="behance" id="behance"  placeholder="Enter the link to your behance account">
                </div>
                <div class="form_group">
                    <label for="website">Website</label>
                    <input value="{{ $users->website }}" class="form-control" type="url" name="website" id="website"  placeholder="Enter the link to your website">
                    <small id="fieldHelp" class="form-text text-muted">*These fields are required</small>
                </div>

                <button type="submit" class="btn btn-primary" name="register-student">update profile</button>
            </form>
        </div>

    </div>
@stop 
