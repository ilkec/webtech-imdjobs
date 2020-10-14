
@extends('partials.app')

@section('content')
    <h1>Signup</h1>
    <div class="container-signup">
        <div class="container-signup-student">
        <h2>I am a student</h2>
        <form class="w-80 border-3 rounded-0 form-signup-student" action="" method="post"
            enctype="multipart/form-data">
            <div class="form_group profileform">
                <label for="firstname-student">Firstname</label>
                <input class="form-control" type="text" value="" name="firstname" id="firstname-student">
            </div>
            <div class="form_group profileform">
                <label for="lastname-student">Lastname</label>
                <input class="form-control" type="text" value="" name="lastname" id="lastname-student">
            </div>
            <div class="form_group profileform">
                <label for="email-student">Email</label>
                <input class="form-control" type="text" value="" name="email" id="email-student">
            </div>
            <div class="form-check hidden">
                <input type="checkbox" class="form-check-input" id="check-student" value="1">
                <label class="form-check-label" for="check-student">Student</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        </div>

        <div class="container-signup-employer">
        <h2>I am an employer</h2>
        <form class="w-80 border-3 rounded-0 form-signup-employer" action="" method="post"
            enctype="multipart/form-data">
            <div class="form_group profileform">
                <label for="firstname-employer">Firstname</label>
                <input class="form-control" type="text" value="" name="firstname" id="firstname-employer">
            </div>
            <div class="form_group profileform">
                <label for="lastname-employer">Lastname</label>
                <input class="form-control" type="text" value="" name="lastname" id="lastname-employer">
            </div>
            <div class="form_group profileform">
                <label for="email-employer">Email</label>
                <input class="form-control" type="text" value="" name="email" id="email-employer">
            </div>
            <div class="form-check hidden">
                <input type="checkbox" class="form-check-input" id="check-employer" value="0">
                <label class="form-check-label" for="check-employer">Employer</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        </div>
    </div>
@stop 
