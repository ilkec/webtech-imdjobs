@extends('partials.app')

@section('title')
    Interact home
@stop

@section('content')
    @if( $session = session('User') )
        $usermail = $session;
    @endif
    
    
@endsection