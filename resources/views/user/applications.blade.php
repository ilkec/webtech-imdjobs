@extends('partials.app')

@section('title')
My applications
@stop

@section('content')
@if ($users->account_type == 0 )
<h1>Applications</h1>
 @if(session('login'))
        <div class="alert alert-warning"> {{ session('login') }} </div>
      @endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">Company</th>
      <th scope="col">Job title</th>
      <th scope="col">Applicant</th>
      <th scope="col">Status</th>
      <th scope="col">Internship</th>
    </tr>
  </thead>
  <tbody>
    @foreach( $applicationsCompany as $application)
    <tr>
      <td>{{$application->name}}</td>
      <td>{{$application->title}}</td>
      <td>{{$application->first_name}} {{$application->last_name}}</td>
      @if ($application->status == 0)
      <td>New</td>
      @elseif ($application->status == 1)
      <td>Under review</td>
      @elseif ($application->status == 2)
      <td>Declined</td>
      @elseif ($application->status == 3)
      <td>Approved</td>
      @endif
      <td><a href="/companies/{{$application->companies_id}}/internships/{{$application->internships_id}}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">View internship</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<h1>My applications</h1>
 @if(session('login'))
        <div class="alert alert-warning"> {{ session('login') }} </div>
      @endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">Job title</th>
      <th scope="col">Internship</th>
      <th scope="col">Status</th>
      <th scope="col">Feedback</th>
    </tr>
  </thead>
  <tbody>
    @foreach( $applicationsUser as $application)
    <tr>
      <td>{{$application->title}}</td>
      <td><a href="/companies/{{$application->companies_id}}/internships/{{$application->internships_id}}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">View internship</a></td>
      @if ($application->status == 0)
      <td>Under review</td>
      @elseif ($application->status == 1)
      <td>Under review</td>
      @elseif ($application->status == 2)
      <td>Declined</td>
      @elseif ($application->status == 3)
      <td>Approved</td>
      @endif
      <td>{{ $application->feedback }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif

@stop