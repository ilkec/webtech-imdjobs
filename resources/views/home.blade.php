@extends('partials.app')

@section('title')
    Interact home
@stop

@section('content')
    @if( $flash = session('User') )
        <a href="/user/profile/{{ $flash }}"><button type="button" class="btn btn-primary">checkout profile</button></a>
    @endif

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
            <select class="custom-select" id="inputTypeSelect">
                <option selected>graphic design</option>
                <option value="1">UI/UX design</option>
                <option value="2">front-end development</option>
                <option value="3">back-end development</option>
                <option value="3">full-stack development</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" placeholder="City">
        </div>
        
        <button type="submit" class="btn btn-primary">Search!</button>
    </form>
    
    
@endsection