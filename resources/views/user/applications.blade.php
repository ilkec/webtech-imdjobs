@extends('partials.app')

@section('title')
My applications
@stop

@section('content')

<h1>My applications</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Job title</th>
      <th scope="col">Internship</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach( $applications as $application)
    <tr>
      <td>{{$application->title}}</td>
      <td><a href="/companies/{{$application->companies_id}}/internships/{{$application->internship_id}}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">View internship</a></td>
      @if ($application->status == 0)
      <td>Under review</td>
      @elseif ($application->status == 1)
      <td>Under review</td>
      @elseif ($application->status == 2)
      <td>Accepted</td>
      @elseif ($application->status == 3)
      <td>Declined</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>

@stop