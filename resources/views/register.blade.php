
@extends('partials.app')

@section('class', 'bg__img')

@section('title')
    Register
@stop

@section('navigation')
        <p>Interact</p>
        <div>
            <a href="/login">
                <button type="button" class="btn btn-light">login</button>
            </a>
            <a href="/register">
                <button type="button" class="btn btn-primary">register</button>
            </a>
        </div>
@stop 

@section('content')
    <div class="container-signup">
        <h2 id="header-student" class="header-signup" onclick="myFunction()">I am a student</h2>
        <h2 id="header-employer" class="header-signup" onclick="myFunctionI()">I am an employer</h2>
        <div id="container-signup-student">
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
                        <input type="hidden" name="accountType" id="account-type" value="1"> 
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-primary" name="register-student">Sign me up</button>
                </div>   
            </form>
            
            
        </div>
        
    </div>
    <div class="center">
        <p>Already have an account? <a href="login">login</a> here!</p>
    </div>
    <script>
        function myFunctionI() {
            var accountType = 0;
            var x = document.getElementById("container-signup-student");
            var student = document.getElementById("header-student");
            var employer = document.getElementById("header-employer");
            var smallText = document.getElementById("emailHelp");
            var accountTypeDiv = document.getElementById("account-type");

            x.style.display = "block";
            smallText.innerHTML = "We'll never share your email with anyone else.";
            accountTypeDiv.value = accountType;
            student.style.backgroundColor = "#F2F2F2";
            employer.style.backgroundColor = "#56A7F1";
        }
        function myFunction() {
            var accountType = 1;
            var x = document.getElementById("container-signup-student");
            var student = document.getElementById("header-student");
            var employer = document.getElementById("header-employer");
            var smallText = document.getElementById("emailHelp");
            var accountTypeDiv = document.getElementById("account-type");

            x.style.display = "block";
            smallText.innerHTML = "Only register with schoolmail for example: firstname.lastname@student.thomasmore.be";
            accountTypeDiv.value = accountType;
            employer.style.backgroundColor = "#F2F2F2";
            student.style.backgroundColor = "#56A7F1";
        }        
    </script>
    
@stop 
