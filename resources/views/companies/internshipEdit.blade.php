@extends('partials.app')

@section('title')
    edit internship
@stop

@section('content')
   <form method="post" action="">
        {{csrf_field()}}
        <h2>Edit your internship for {{$company->name}}</h2>
       <h4>All fields are required</h4>
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
            <label for="title">internship title *</label>
            <input name="title" type="text" class="form-control" id="title" value="{{$internship->title}}" placeholder="Internship title">
        </div>
        <div class="form-group">
            <label for="description">description *</label>
            <textarea name="description" class="form-control" id="description" placeholder="Our company values its employees and has a real passion for:">{{$internship->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="tasks">tasks *</label>
            <textarea name="tasks" class="form-control" id="tasks" placeholder="the tasks you can expect at this internship are:">{{$internship->tasks}}</textarea>
        </div>
        <div class="form-group">
            <label for="profile">profile *</label>
            <textarea name="profile" class="form-control" id="profile" placeholder="the profile we are looking for is:">{{$internship->profile}}</textarea>
        </div>
        <div class="form-group">
            <label for="type">Internship type *</label>
            <select name="type" class="custom-select" id="inputTypeSelect">
                <option value="graphic design" @if($internship->type == "graphic design") selected @endif>graphic design</option>
                <option value="UI/UX"  @if($internship->type == "UI/UX") selected @endif>UI/UX design</option>
                <option value="front-end" @if($internship->type == "front-end") selected @endif>front-end development</option>
                <option value="back-end" @if($internship->type == "back-end") selected @endif>back-end development</option>
                <option value="full-stack" @if($internship->type == "full-stack") selected @endif>full-stack development</option>
            </select>
        </div>

        <div class="form-group">
            <label for="city">City *</label>
            <input name="city" type="text" class="form-control" id="city" value="{{$internship->city}}" placeholder="City">
        </div>
        <div class="form-group">
            <label for="postal_code">Postal code *</label>
            <input name="postal_code" type="text" class="form-control" id="postal_code" value="{{$internship->postal_code}}" placeholder="Postal Code">
        </div>
        
        <button type="submit" class="btn btn-primary">Add internship</button>
    </form>
@endsection