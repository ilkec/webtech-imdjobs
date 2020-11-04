@extends('partials.app')

@section('title')
    All companies
@stop

@section('content')
    <h1>All companies</h1>
    @foreach( $companies as $company)
    <div>
        <a href="/companies/{{ $company->id }}"><h2>{{ $company->name }}</h2></a>
        <div class='description'>
            <p>{{$company->description}}</p>
        </div>
        <div class="container-img">
            <img class="img-thumbnail" src="{{ asset('storage/' . $company->picture) }}" width="500" height="500" alt="companylogo" id="companyPicture">
        </div>
    </div>
    @endforeach
@endsection