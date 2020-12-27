@extends('partials.app')

@section('class', 'bg__img')

@section('title')
    Login
@stop

@section('content')
    @if( $flash = session('message') )
        <div class="alert alert-success">{{ $flash }}</div>
    @endif
    @if( $flash2 = session('Login') )
        <div class="alert alert-danger">{{ $flash2 }}</div>
    @endif
    <div class="container-login">
        <form method="post" action="">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" value="{{ old('email') }}" name ="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>
    <div class="center">
        <p>Don't have an account yet? <a href="register">Register</a> here!</p>
    </div>
@endsection