@extends('partials.app')

@section('title')
    {{$company->name}} profile
@stop

@section('content')
 
        <section>
        <div class="img-thumbnail">
            <img src="{{ asset('storage/' . $company->picture) }}" alt="Company logo" id="companyLogo">
        </div>
        <h2>{{$company->name}}</h2>
        <p>{{$company->description}}</p>
        </section>

        <section style="background-color: #f7f7f7">
            @if($flash = session('addInternshipError'))
                <div class="alert alert-danger"> {{ $flash }} </div>
            @endif
            @if(\Auth::user()->can('update', $company))
            <form method="post" action="">
            {{csrf_field()}}
                <button type="submit" class="btn btn-primary">Add Internship offer</button>
            </form>
            @endif
            @foreach ($internships as $internship)
                <div>  
                    <h4>{{$internship->title}}</h4>
                    <p>{{$internship->description}}</p>
                </div>
            @endforeach
        </section>
            
        <section>
            <h3>Contact details</h3>
            <p>{{$company->street_address}}, {{ $company->postal_code}} {{$company->city}}</p>
            <p>{{$company->phone_number}}</p>
            <p>{{$company->email}}</p>
        </section>

       
@endsection