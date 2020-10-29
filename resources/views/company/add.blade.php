@extends('partials.app')

@section('title')
    Add a company
@stop

@section('content')
   <form method="post" action="">
        {{csrf_field()}}
        <h2>Add a company</h2>

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
            <label for="name">Company name</label>
            <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Company name">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" id="city" value="{{old('city')}}" placeholder="City">
        </div>
        
        <button type="submit" class="btn btn-primary">Add company</button>
    </form>
@endsection