@extends('partials.app')

@section('title')
    edit internship
@stop

@section('content')
    <div>
        <h1>Deleting internship: {{$internship->title}}</h1>
        <p>Are you sure you want to delete this internship: </p>
        <p>name: {{$internship->title}} <br>
        city: {{$internship->city}}</p>

        <a href="/companies/{{ $company->id }}"><button  type="button" class="btn btn-danger">No, cancel</button></a> 
        <form method="post" action="" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary">Yes, delete</button>
        </form>
    </div>
@endsection