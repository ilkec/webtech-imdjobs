@extends('partials.app')

@section('title')
    Internships
@stop

@section('content')

@if($nearbyInternships)
        <h1>Internships in {{$nearbyInternships[0]->city}}</h1>
        <section>
        @foreach ($nearbyInternships as $nearbyInternship)
        <div>
            <a href="/companies/{{$nearbyInternship->companies_id}}/internships/{{$nearbyInternship->id}}"><h2>{{$nearbyInternship->title}}</h2></a>
            <div class="flexed">
                <P>Description:</p>
                <p class="flexed__item">{{$nearbyInternship->description}}</p>
            </div>
            <div class="flexed">
                <P>Tasks:</p>
                <p class="flexed__item">{{$nearbyInternship->tasks}}</p>
            </div>
            <section class="row">
                <div>
                    <a href="/companies/{{$nearbyInternship->companies_id}}"><p>{{$companies[array_search($nearbyInternship->companies_id,array_column($companies,'id'))]->name}}</p></a>
                    <p>{{$nearbyInternship->postal_code}}, {{$nearbyInternship->city}}</p>
                </div>
                <div class="container-img">
                    @if (empty( $companies[array_search($nearbyInternship->companies_id,array_column($companies,'id'))]->picture ))
                        <img class="img-thumbnail img-thumbnail--small" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                    @else
                        <img class="img-thumbnail img-thumbnail--small" src="storage/{{$companies[array_search($nearbyInternship->companies_id,array_column($companies,'id'))]->picture}}" width="500" height="500" alt="profilepicture" id="profilePicture">
                    @endif
                </div>
            </section>  
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
<section>
    @foreach ($otherInternships as $internship)
   <div>
        <a href="/companies/{{$internship->companies_id}}/internships/{{$internship->id}}"><h2>{{$internship->title}}</h2></a>
        <div class="flexed">
            <P>Description:</p>
            <p class="flexed__item">{{$internship->description}}</p>
        </div>
        <div class="flexed">
            <P>Tasks:</p>
            <p class="flexed__item">{{$internship->tasks}}</p>
        </div>

        <section class="row">
            <div>
                <a href="/companies/{{$internship->companies_id}}"><p>{{$companies[array_search($internship->companies_id,array_column($companies,'id'))]->name}}</p></a>
                <p>{{$internship->postal_code}}, {{$internship->city}}</p>
            </div>
            <div class="container-img">
                @if (empty($companies[array_search($internship->companies_id,array_column($companies,'id'))]->picture))
                    <img class="img-thumbnail img-thumbnail--small" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @else
                    <img class="img-thumbnail img-thumbnail--small" src="storage/{{$companies[array_search($internship->companies_id,array_column($companies,'id'))]->picture}}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @endif
            </div>
        </section>
    </div>
    <hr>
    @endforeach
</section>
@endsection