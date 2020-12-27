@extends('partials.app')

@section('title')
    Internships
@stop

@section('content')

    @if($nearbyInternships)
            <h1>Internships in {{$nearbyInternships[0]->city}}</h1>
            <section id="internships">  
                <internship v-for="internship in internships" v-bind:companies_id="internship.companies_id" v-bind:id="internship.id" v-bind:title="internship.title" v-bind:description="internship.description" v-bind:tasks="internship.tasks" v-bind:postal_code="internship.postal_code" v-bind:city="internship.city" v-bind:name="internship.companies.name">
                </internship>
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
            <section id="others">  
                <internship v-for="internship in internships" v-bind:companies_id="internship.companies_id" v-bind:id="internship.id" v-bind:title="internship.title" v-bind:description="internship.description" v-bind:tasks="internship.tasks" v-bind:postal_code="internship.postal_code" v-bind:city="internship.city" v-bind:name="internship.companies.name">
                </internship>
            </section>
    </section>   
    <script>
        let nearbyInternships =<?php echo $nearbyInternshipsJSON ?>;
        let otherInternships =<?php echo $otherInternshipsJSON ?>;
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

