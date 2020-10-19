
@extends('partials.app')

@section('title')
    Register
@stop

@section('content')
    <h1>Register</h1>
    <div class="container-signup">
        <div class="container-signup-student">
            <h2>I am a student</h2>
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
                    <label for="firstname-student">Firstname</label>
                    <input value="{{ old('firstname') }}" class="form-control" type="text" name="firstname" id="firstname-student" aria-describedby="emailHelp" placeholder="Enter your first name">
                </div>
                <div class="form_group">
                    <label for="lastname-student">Lastname</label>
                    <input value="{{ old('lastname') }}" class="form-control" type="text" name="lastname" id="lastname-student" aria-describedby="emailHelp" placeholder="Enter your last name">
                </div>

                <div class="form-group">
                    <label for="email-student">Email address</label>
                    <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email-student" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">Only register with schoolmail for example: firstname.lastname@student.thomasmore.be</small>
                </div>
                <div class="form-group">
                    <label for="password-student">Password</label>
                    <input type="password" name="password" class="form-control" id="password-student" placeholder="Password">
                </div>
                <div class="form-check hidden">
                    <input type="hidden" name="accountType" value="1"> 
                </div>
                
                <button type="submit" class="btn btn-primary" name="register-student">Sign me up</button>
            </form>
        </div>

        <div class="container-signup-employer">
            <h2>I am an employer</h2>
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
                        <label for="firstname-employer">Firstname</label>
                        <input value="{{ old('firstname') }}" class="form-control" type="text" name="firstname" id="firstname-employer" aria-describedby="emailHelp" placeholder="Enter your first name">
                    </div>
                    <div class="form_group">
                        <label for="lastname-employer">Lastname</label>
                        <input value="{{ old('lastname') }}" class="form-control" type="text" name="lastname" id="lastname-employer" aria-describedby="emailHelp" placeholder="Enter your last name">
                    </div>

                    <div class="form-group">
                        <label for="email-employer">Email address</label>
                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email-employer" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password-employer">Password</label>
                        <input type="password" name="password" class="form-control" id="password-employer" placeholder="Password">
                    </div>
                    <div class="form-check hidden">
                        <input type="hidden" name="accountType" value="0"> 
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="register-employer">Sign me up</button>
                </form>
        </div>
    </div>
@stop 
