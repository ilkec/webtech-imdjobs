@extends('partials.app')

@section('title')
    Internships
@stop

@section('content')

@if($nearbyInternships)
        <h1>Internships in {{$nearbyInternships[0]->city}}</h1>
        <section class="gray">
        @foreach ($nearbyInternships as $nearbyInternship)
        <a href="/companies/{{$nearbyInternship->company_id}}/internships/{{$nearbyInternship->id}}"><div>
            <h2>{{$nearbyInternship->title}}</h2>
            <p>{{$nearbyInternship->description}}</p>
        </div></a>
        @endforeach
    </section>
@endif
<hr>
@if(empty($nearbyInternships))
    <h1>Sorry! We did not find any internships of this type in your city, but here are some internships of this type in other places</h1>
@else
    <h1>All internships of this type:</h1>
@endif
<section class="gray">
    @foreach ($internships as $internship)
    <a href="/companies/{{$internship->company_id}}/internships/{{$internship->id}}"><div>
        <h2>{{$internship->title}}</h2>
        <p>{{$internship->description}}</p>
    </div>
    @endforeach
</section>
@endsection