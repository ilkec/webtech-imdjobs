@extends('partials.app')

@section('title')
    Profile
@stop

@section('content')
    <h1>Profile</h1>
    <div class="container-profile">
        <div class="container-profile">
            <form action="" method="post">
                @csrf

                <div class="form_group">
                    <label for="firstname">Firstname</label>
                    <input value="{{ $users->first_name }}" class="form-control" type="text" name="firstname" id="firstname" aria-describedby="emailHelp" placeholder="Enter your first name">
                </div>
                <div class="form_group">
                    <label for="lastname">Lastname</label>
                    <input value="{{ $users->last_name }}" class="form-control" type="text" name="lastname" id="lastname" aria-describedby="emailHelp" placeholder="Enter your last name">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input value="{{ $users->description }}" type="input" name="description" class="form-control" id="description" placeholder="description">
                </div>

                <div class="form_group">
                    <label for="phonenumber">Phonenumber</label>
                    <input value="{{ $users->phone_number }}" class="form-control" type="text" name="phonenumber" id="phonenumber"  placeholder="Enter your phonenumber">
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input value="{{ $users->city }}" type="input" name="city" class="form-control" id="city" placeholder="City">
                </div>
                <div class="form-check hidden">
                    <input type="hidden" name="accountType" value="1"> 
                </div>
                
                <button type="submit" class="btn btn-primary" name="register-student">update profile</button>
            </form>
        </div>

    </div>
@stop 
