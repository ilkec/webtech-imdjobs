@extends('partials.app')

@section('title')
Edit applications status
@stop

@section('content')

<form method="post" action="">
    {{csrf_field()}}
    <h2>Edit application status</h2>

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
        <select name="status" id="cars">
            <option value="1">Starred</option>
            <option value="2">Declined</option>
            <option value="3">Approved</option>
        </select>
        <label for="feedback">Write feedback</label>
        <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="10" placeholder="Write something to the candidate"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection