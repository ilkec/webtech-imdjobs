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
            @if($flash = session('addInternshipError'))
                <div class="alert alert-danger"> {{ $flash }} </div>
            @endif
            <form method="post" action="">
            {{csrf_field()}}
                <button type="submit" class="btn btn-primary">Add Internship offer</button>
            </form>
        </section>

        <section>
            <h3>Contact details</h3>
            <p>{{$company->street_address}}, {{ $company->postal_code}} {{$company->city}}</p>
            <p>{{$company->phone_number}}</p>
            <p>{{$company->email}}</p>
        </section>

       
@endsection