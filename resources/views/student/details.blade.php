@extends('partials.app')

@section('title')
    Profile
@stop

@section('content')
    <h1>test dribbble</h1>
    @for ($i = 0; $i < 5; $i++)
        
        <a href="{{ $testing[$i]['link'] }}">
            <img src="{{ $testing[$i]['image']}}" alt="test">
        </a>
    @endfor
  

   
@stop
