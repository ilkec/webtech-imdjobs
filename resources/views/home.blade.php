@extends('partials.app')

@section('title')
    Interact home
@stop

@section('class', 'bg__img')

@section('content')   
    <form method="post" action="" class="form__filter">
        {{csrf_field()}}
        <h2>Search for an internship</h2>

        @if( $errors->any())
        @component('components/alert')
            @slot('type') danger @endslot
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endcomponent
        @endif
        <div class="form-group">
            <label for="type">Internship type</label>
            <select name="type" class="custom-select" id="inputTypeSelect">
                <option value="graphic design" selected>graphic design</option>
                <option value="UI/UX">UI/UX design</option>
                <option value="front-end">front-end development</option>
                <option value="back-end">back-end development</option>
                <option value="full-stack">full-stack development</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" placeholder="City">
        </div>
        
        <div class="center">
            <button type="button" class="btn btn-primary btn-lg" id="btn-searchInternship">Search!</button>
        </div>
         <div class="center margin-top">
            <p>look for a <a href="/companies">company</a> instead?</p>
        </div> 
    </form> 


    @if(isset($searched))
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
    @endif
    <script src="{{ asset('js/app.js') }}"></script>
@stop
