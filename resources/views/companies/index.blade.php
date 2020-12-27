@extends('partials.app')

@section('title')
    All companies
@stop

@section('class', 'bg__img')

@section('content')
  
     <form method="post" action=""  class="form__filter">
        {{csrf_field()}}
        <h2>All companies</h2>
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
            <label for="Company">Company or city</label>
            <input name="Company" type="text" class="form-control" id="Company or city" placeholder="Company" @if(isset($request)) value="{{$request}}" @endif>
        </div>

        <div class="center">
            <button type="submit" class="btn btn-primary btn-lg">Search!</button>
        </div>
        <div class="center margin-top">
            <p>look for an <a href="/">internship</a> instead?</p>
        </div> 
    </form>
   
     @if(session('User') && $user->account_type === 0)
        <h3>My companies</h3>
         <div class="margin-top">
            <p>Don't have a company yet? <a href="/company/add">Add your company</a> by clicking here</p>
        </div> 
        <section class="list list--companies">
            @foreach( $mycompanies as $company)
            <div class="list__item">
                <a href="/companies/{{ $company->id }}"><h2>{{ $company->name }}</h2></a>
                <div class='description'>
                    <p>{{$company->description}}</p>
                </div>
                <div class="container-img">
                @if (empty( $company->picture ))
                    <img class="img-thumbnail margin-bottom" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @else
                    <img class="img-thumbnail margin-bottom" src="{{ asset('storage/' . $company->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @endif
                </div>
                
            </div>
            @endforeach
        </section>
    @endif

    @if(isset($companies))
        <h3>Looking for {{ $request }}</h3>
        <section class="list list--companies">
            @foreach( $companies as $company)
            <div class="list__item">
                <a href="/companies/{{ $company->id }}"><h2>{{ $company->name }}</h2></a>
                <div class='description'>
                    <p>{{$company->description}}</p>
                </div>
                <div class="container-img">
                @if (empty( $company->picture ))
                    <img class="img-thumbnail margin-bottom" src="{{ asset('images/profilePic.jpg') }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @else
                    <img class="img-thumbnail margin-bottom" src="{{ asset('storage/' . $company->picture) }}" width="500" height="500" alt="profilepicture" id="profilePicture">
                @endif
                </div>
                
            </div>
            @endforeach
        </section>
    @endif
@endsection