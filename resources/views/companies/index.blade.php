@extends('partials.app')

@section('title')
    All companies
@stop

@section('content')
    <h1>All companies</h1>
    @if($user->account_type === 0)
        <a href="/company/add">
            <button class="btn btn-primary">Add company</button>
        </a>
    @endif
     <form method="post" action="">
        {{csrf_field()}}

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
            <label for="Company">Company</label>
            <input name="Company" type="text" class="form-control" id="Company" placeholder="Company">
        </div>
        
        <button type="submit" class="btn btn-primary">Filter!</button>
    </form>
    <section class="list list--companies">
        @foreach( $companies as $company)
        <div class="list__item">
            <a href="/companies/{{ $company->id }}"><h2>{{ $company->name }}</h2></a>
            <div class='description'>
                <p>{{$company->description}}</p>
            </div>
            <div class="container-img">
                <img class="img-thumbnail" src="{{ asset('storage/' . $company->picture) }}" width="500" height="500" alt="companylogo" id="companyPicture">
            </div>
        </div>
        @endforeach
    </section>
@endsection