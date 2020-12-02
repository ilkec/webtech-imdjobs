@extends('partials.app')

@section('title')
    Internships
@stop

@section('content')

@if($nearbyInternships)
        <h1>Internships in {{$nearbyInternships[0]->city}}</h1>
        <section class="gray">
        @foreach ($nearbyInternships as $nearbyInternship)
        <div>
         <a href="/companies/{{$nearbyInternship->companies_id}}/internships/{{$nearbyInternship->id}}"><h2>{{$nearbyInternship->title}}</h2></a>
        <div>
            <P>Description:</p>
            <p>{{$nearbyInternship->description}}</p>
        </div>
        <div>
            <P>Tasks:</p>
            <p>{{$nearbyInternship->tasks}}</p>
        </div>
        <a href="/companies/{{$nearbyInternship->company_id}}"><p>{{$companies[array_search($nearbyInternship->company_id,array_column($companies,'id'))]->name}}</p></a>
        <p>{{$nearbyInternship->postal_code}}, {{$nearbyInternship->city}}</p>
    </div>
    <hr>
        @endforeach
    </section>
@endif
@if(empty($nearbyInternships) && empty($otherInternships))
    <h1>Sorry! there are currently no internships of this type available.</h1>
@elseif(empty($nearbyInternships))
    <h1>Sorry! We did not find any internships of this type in your city, but here are some internships of this type in other places:</h1>
@else
    <h1>internships in other cities:</h1>
@endif
<section class="gray">
    @foreach ($otherInternships as $internship)
   <div>
         <a href="/companies/{{$internship->companies_id}}/internships/{{$internship->id}}"><h2>{{$internship->title}}</h2></a>
        <div>
            <P>Description:</p>
            <p>{{$internship->description}}</p>
        </div>
        <div>
            <P>Tasks:</p>
            <p>{{$internship->tasks}}</p>
        </div>
        <a href="/companies/{{$internship->company_id}}"><p>{{$companies[array_search($internship->company_id,array_column($companies,'id'))]->name}}</p></a>
        <p>{{$internship->postal_code}}, {{$internship->city}}</p>
    </div>
    <hr>
    @endforeach
</section>
@endsection