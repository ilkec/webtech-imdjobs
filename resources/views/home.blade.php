@extends('partials.app')

@section('title')
    Interact home
@stop

@section('content')
    @if( $flash = session('User') )
        <a href="/user/profileUpdate/{{ $flash }}"><button type="button" class="btn btn-primary">update profile</button></a>
    @endif
    
    
@endsection