@extends('partials.app')

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
    
    <form method="post" action="">
        @csrf
        <h2>Log in</h2>
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
@endsection