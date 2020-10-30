@extends('partials.app')

@section('title')
    Interact home
@stop

@section('content')
    
    <form method="post" action="">
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
                <option value="font-end">front-end development</option>
                <option value="back-end">back-end development</option>
                <option value="full-stack">full-stack development</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" placeholder="City">
        </div>
        
        <button type="submit" class="btn btn-primary">Search!</button>
    </form>

    
    
    
@stop