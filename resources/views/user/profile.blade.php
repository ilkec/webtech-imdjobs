@extends('partials.app')

@section('title')
    Profile
@stop
@section('content')
    @if( $flash = session('updateMessage') )
        <div class="alert alert-success">{{ $flash }}</div>
    @endif
    <h1>Hi, i'm {{ $users->first_name }} {{ $users->last_name }}</h1>
    <img src="{{ $users->picture }}" alt="profilepicture">
    <div class='description'>
        <h4>What I would like you to know</h4>
        <p>{{ $users->description }}</p>
        <p> I live in {{ $users->city }}</p>
    </div>
    <div class='contact'>
        <h4>You can contact me by mail or give me a call </h4>
        <p>{{ $users->email }}</p>
        <p>{{ $users->phone_number }}</p>
    </div>
    
    <div class='links'>
        <h4>Glimpse of my portfolio </h4>
        @if (!empty( $users->website ))
            <a href="{{ $users->website }}"><p>Website</p></a>
        @endif
        @if (!empty( $users->linkedin ))
            <a href="{{ $users->linkedin }}"><p>Linkedin</p></a>
        @endif
        @if (!empty( $users->dribbble ))
            <a href="{{ $users->dribbble }}"><p>Dribbble</p></a>
        @endif
        @if (!empty( $users->behance ))
            <a href="{{ $users->behance }}"><p>Behance</p></a>
        @endif
        
        @if( $flash = session('User') === $users->id )
            <a href="/user/update"><button type="button" class="btn btn-primary">update profile</button></a>
        @endif
        
        
    </div>
@stop