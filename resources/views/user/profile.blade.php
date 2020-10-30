@extends('partials.app')

@section('title')
    Profile
@stop
 
@section('content')
    @if( $flash = session('updateMessage') )
        <div class="alert alert-success">{{ $flash }}</div>
    @endif
    <h1>{{ $users->first_name }} {{ $users->last_name }}</h1>
    <p> I live in {{ $users->city }}</p>
    <div class='description'>
        <p>{{ $users->description }}</p>
    </div>
    
    <div class="container-img">
    @if (empty( $users->picture ))
        <img class="img-thumbnail" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
    @else
        <img class="img-thumbnail" src="{{ asset('storage/' . $users->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
        @endif
    </div>

    
    
    <div class='contact'>
        <h4>You can contact me by mail or give me a call </h4>
        <div>
            <!--icon mail-->
            <p>{{ $users->email }}</p>
        </div>
        <div>
            <!--icon phone-->
            <p>{{ $users->phone_number }}</p>
        </div>
        
        
    </div>
    
    @if (!empty( $users->cv ))
    <a href="{{ asset('storage/' . $users->cv) }}" download="cv_{{ $users->first_name }}_{{ $users->last_name }}">
        <p>Download my cv</p>
    </a>    
    @endif
    
    @if (!empty( $users->website ) || !empty( $users->linkedin ) || !empty( $users->dribbble ) || !empty( $users->behance ) || !empty( $users->github ) )
    <div class='links'>
        <h4>Glimpse of my portfolio </h4>
        @if (!empty( $users->website ))
            <a href="{{ $users->website }}"><p>Website</p></a>
        @endif
        @if (!empty( $users->linkedin ))
            <a href="{{ $users->linkedin }}"><p>Linkedin</p></a>
        @endif
        @if (!empty( $users->dribbble ))
            <!--<a href="{{ $users->dribbble }}"><p>Dribbble</p></a>-->
            @for ($i = 0; $i < 5; $i++)
                
                <a href="{{ $items[$i]['link'] }}">
                    <img src="{{ $items[$i]['image']}}" alt="portfolio item">
                </a>
            @endfor
        @endif
        <!--@if (!empty( $users->behance ))
            <a href="{{ $users->behance }}"><p>Behance</p></a>
        @endif-->
        @if (!empty( $users->github ))
            <a href="{{ $users->github }}"><p>Github</p></a>
        @endif
    @endif
        
        @if( $flash = session('User') === $users->id )
            <a href="/user/update"><button type="button" class="btn btn-primary">update profile</button></a>
            
        @endif
        
        
    </div>
@stop