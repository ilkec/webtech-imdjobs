@extends('partials.app')

@section('title')
    Interact home
@stop

@section('content')
    @if( $flash = session('User') )
        <a href="/user/profile/{{ $flash }}"><button type="button" class="btn btn-primary">checkout profile</button></a>
        <a href="/user/applications"><button type="button" class="btn btn-primary">View applications</button></a>
    @endif
    
    
@endsection