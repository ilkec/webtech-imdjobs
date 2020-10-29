@extends('partials.app')

@section('title')
    Login
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
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>
@endsection