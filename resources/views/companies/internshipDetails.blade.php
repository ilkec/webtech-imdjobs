@extends('partials.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

<!-- @foreach( $applications as $application)
<div class="container">
  <div class="row">
    <div class="col-sm">
    <p>{{$application->first_name}}</p>
    </div>
    <div class="col-sm">
      <p><td>{{$application->last_name}}</td></p>
    </div>
    <div class="col-sm">
    <a href="/user/profile/{{$application->user_id}}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">View Profile</a>
    </div>
    <div class="col-sm">
      One of three columns
    </div>
  </div>
</div>
@endforeach -->

<table class="table">
  <thead>
    <tr>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Profile</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach( $applications as $application)
    <tr>
      <!-- $user = zoek in de database in de tabel users naar de user met id $application->user_id -->
      <!-- <td>$user[firstname]</td>
      <td>$user[lastname]</td> -->
      <td>{{$application->first_name}}</td>
      <td>{{$application->last_name}}</td>
      <td><a href="/user/profile/{{$application->user_id}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">View Profile</a></td>
      <td><p>
        @if ($application->status == 0) New @endif
        @if ($application->status == 1) Starred @endif
        @if ($application->status == 2) Declined @endif
        @if ($application->status == 3) Approved @endif
      </p></td>
      <td><a href=""><button type="button" class="btn btn-success btn-sm">Edit status</button></a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection