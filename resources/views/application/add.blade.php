@extends('partials.app')

@section('title')
   Send application
@stop

@section('content')
   <form method="post" action="">
        {{csrf_field()}}
        <h2>Job application</h2>

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
            <label for="message">Write message</label>
            <textarea name="message" id="message" class="form-control" cols="30" rows="10" placeholder="Write something more about you"></textarea>
        </div>        
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
@endsection