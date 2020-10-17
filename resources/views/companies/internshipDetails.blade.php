@extends('partials.app')

@section('content')
<h1>Internship details</h1>
@foreach( $details as $detail)
@section('title')
{{$detail->title}}
@stop
<p>{{ $detail->title }}</p>
<p>{{ $detail->description }}</p>
<p>{{ $detail->tasks }}</p>
@endforeach
<h1>Applications for this internship</h1>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Profile</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach( $applications as $application)
    <tr>
      <!-- $user = zoek in de database in de tabel users naar de user met id $application->user_id -->
      <!-- <td>$user[firstname]</td>
      <td>$user[lastname]</td> -->
      <td>{{$application->user_id}}</td>
      <td></td>
      <td><a href="#" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">View Profile</a></td>
      <td><select class="form-control" id="exampleFormControlSelect1">
        <option>Een</option>
        <option>Twee</option>
        <option>Drie</option>
        <option>Vier</option>
    </select></td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection