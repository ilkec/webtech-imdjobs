@extends('partials.app')

@section('title')
    {{$company->name}} profile
@stop

@section('content')
 
        <section>
        <h2>{{$company->name}}</h2>
        <p>{{$company->description}}</p>
        </section>

        <section>
            
        </section>

        <section>
            <h3>Contact details</h3>
            <p>{{$company->street_address}}, {{ $company->postal_code}} {{$company->city}}</p>
            <p>{{$company->phone_number}}</p>
            <p>{{$company->email}}</p>
        </section>

       
@endsection