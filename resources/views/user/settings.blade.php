@extends('partials.app')

@section('title')
    profilesettings
@stop

@section('content')
    <div>
        @if( $flash = session('passwordMessage') )
            <div class="alert alert-danger">{{ $flash }}</div>
        @endif
        <h1>Password</h1>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf

            @if( $errors->any() )
                    @component('components/alert')
                        @slot('type', 'danger')
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>   
                    @endcomponent
            @endif

            <div class="form-group">
                <label for="passwordOld">Old password</label>
                <input type="password" name="passwordOld" class="form-control" id="passwordOld" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="passwordNew">New password</label>
                <input type="password" name="passwordNew" class="form-control" id="passwordNew" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">change password</button>
        </form>
    </div>
@endsection