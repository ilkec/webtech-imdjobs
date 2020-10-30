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
<a href="/companies/{{$detail->company_id}}/internships/{{$detail->id}}/applications/add"><button type="button" class="btn btn-success btn-sm">Apply</button></a>

@endforeach
<h1>Applications for this internship</h1>

<form action="" method="GET">
 
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status-all" value="4" @if($status->status == "4") checked @endif>
    <label class="form-check-label" for="status-all">All</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status-new" value="0" @if($status->status == 0) checked @endif>
    <label class="form-check-label" for="status-all">New</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status-starred" value="1" @if($status->status == 1) checked @endif>
    <label class="form-check-label" for="status-all">Starred</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status-approved" value="3" @if($status->status == 3) checked @endif>
    <label class="form-check-label" for="status-all">Approved</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status-declined" value="2" @if($status->status == 2) checked @endif>
    <label class="form-check-label" for="status-all">Declined</label>
  </div>
  <button type="submit" class="btn btn-primary" name="filter">filter status</button>
</form>

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
      @if ($status->status == 4)
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
        <td><a href="/company/{{$application->company_id}}/applications/edit/{{$application->id}}"><button type="button" class="btn btn-success btn-sm">Edit status</button></a></td>
      </tr>
      @elseif ($status->status == $application->status)  
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
        
        <td><a href="/company/{{$application->company_id}}/applications/edit/{{$application->id}}">
            <button type="button" class="btn btn-success btn-sm">Review</button>
          </a></td>
       </tr>
      @endif
    @endforeach
  </tbody>
</table>

@endsection