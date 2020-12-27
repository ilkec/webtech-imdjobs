@extends('partials.app')

@section('title')
    {{$company->name}} profile
@stop

@section('content')
    <div class="head__img"></div>

     <div class="intro profile-group">
        <h1>{{$company->name}}</h1>
        @if(session('User') && \Auth::user()->can('update', $company))
            <a class="btn__company" href="/companies/{{$company->id}}/edit"><button type="submit" class="btn btn-primary">edit company</button></a>
        @endif

        <div class='description'>
            <p>{{$company->description}}</p>
        </div>
    
         <div class="container-img">
        @if (empty( $company->picture ))
            <img class="img-thumbnail" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
        @else
            <img class="img-thumbnail" src="{{ asset('storage/' . $company->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
        @endif
        </div>
    </div>


    <section>
        <div class="button-heading">
            <h3>Current internships</h3>
            @if(session('User') && \Auth::user()->can('update', $company))
                <form method="post" action="">
                {{csrf_field()}}
                    <button type="submit" class="btn btn-primary btn__company">Add Internship offer</button>
                </form>
            @endif
        </div>
        @if($flash = session('addInternshipError'))
            <div class="alert alert-danger"> {{ $flash }} </div>
        @endif
        @foreach ($internships as $internship)
        <div class="row row--centered">
            <a class="internship" href="/companies/{{$internship->companies_id}}/internships/{{$internship->id}}"><div>  
                <h4 class="internship__paragraph">{{$internship->title}}</h4>
                <p class="internship__paragraph">{{$internship->description}}</p>
            </div></a>
            @if(session('User') && \Auth::user()->can('update', $company))
                <div class="button__container">
                    <a href="/companies/{{$internship->companies_id}}/internships/{{$internship->id}}/delete"><button  type="button" class="btn btn-danger">Remove internship</button></a>
                    <a href="/companies/{{$internship->companies_id}}/internships/{{$internship->id}}/edit"><button type="submit" class="btn btn-primary">edit internship</button></a>
                </div>  
            @endif
        </div> 
        <hr>
        @endforeach
    </section>

        <div class="row">
            <section>
                <h3>Contact details</h3>
                <p>{{$company->street_address}}, {{ $company->postal_code}} {{$company->city}}</p>
                <p>{{$company->phone_number}}</p>
                <p>{{$company->email}}</p>
                <P><a href="{{$company->website}}" target="_blank">visit our website!</a></p>
            </section>

            <section>
                <h3>Public Transport</h3>
                @if($company->halte_beschrijving != "")
                    <p>DeLijn: Halte {{$company->halte_beschrijving}} ({{$company->haltenummer}})</p>
                @else
                    <p>No public transport nearby</p>
                @endif
            </section>
        </div>   
@endsection