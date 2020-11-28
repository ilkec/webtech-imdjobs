@extends('partials.app')

@section('title')
{{$details[0]->title}}
@stop

  

@section('content')


  @if(\Auth::user()->can('update', $company))
    <h1>Applications for this internship</h1>
    <form action="" method="GET">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-all" value="4" @if($status == 4) checked @endif>
        <label class="form-check-label" for="status-all">All</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-new" value="0" @if($status == 0) checked @endif>
        <label class="form-check-label" for="status-all">New</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-starred" value="1" @if($status == 1) checked @endif>
        <label class="form-check-label" for="status-all">Starred</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-approved" value="3" @if($status == 3) checked @endif>
        <label class="form-check-label" for="status-all">Approved</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-declined" value="2" @if($status == 2) checked @endif>
        <label class="form-check-label" for="status-all">Declined</label>
      </div>
      <button type="submit" class="btn btn-primary" name="filter">filter status</button>
    </form>

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
          @if ($status == 4)
          <tr>
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
          @elseif ($status == $application->status)  
          <tr>
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
                <button type="button" class="btn btn-success btn-sm">Edit status</button>
              </a></td>
          </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  @else
    <h1>Internship details</h1>
    @foreach( $details as $detail)
      <p>{{ $detail->title }}</p>
      <p>{{ $detail->description }}</p>
      <p>{{ $detail->tasks }}</p>
      <a href="/companies/{{$detail->company_id}}/internships/{{$detail->id}}/applications/add"><button type="button" class="btn btn-success btn-sm">Apply</button></a>
    @endforeach
  @endif



@endsection