@extends('partials.app')

@section('title')
    Interact home
@stop

@section('class', 'bg__img')

@section('content')   
    <form method="post" action="" class="form__filter" onkeydown="return event.key != 'Enter';">
        {{csrf_field()}}
        <h2 class="form__title">Search for an internship</h2>

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
            <button name="searchInternship" type="button" class="btn btn-primary btn-lg" id="btn-searchInternship">Search!</button>
        </div>
         <div class="center margin-top">
            <p>look for a <a href="/companies">company</a> instead?</p>
        </div> 
    </form> 

    <section id="internships"> 
        <h3 class="hidden nearbyInternships">Local internships</h3> 
        <internship v-for="internship in internships" v-bind:companies_id="internship.companies_id" v-bind:id="internship.id" v-bind:title="internship.title" v-bind:description="internship.description" v-bind:tasks="internship.tasks" v-bind:postal_code="internship.postal_code" v-bind:city="internship.city" v-bind:name="internship.companies.name">
        </internship>
    </section>

     <section id="others">  
     <h3 class="hidden otherInternships">Internships in other cities</h3> 
        <internship v-for="internship in internships" v-bind:companies_id="internship.companies_id" v-bind:id="internship.id" v-bind:title="internship.title" v-bind:description="internship.description" v-bind:tasks="internship.tasks" v-bind:postal_code="internship.postal_code" v-bind:city="internship.city" v-bind:name="internship.companies.name">
        </internship>
    </section>
   
    <script src="{{ asset('js/app.js') }}"></script>
@stop
