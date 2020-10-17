<h1>Internship details</h1>
@foreach( $details as $detail)
    <p>{{ $detail->title }}</p>
    <p>{{ $detail->description }}</p>
    <p>{{ $detail->tasks }}</p>
@endforeach
<h1>Applications for this internship</h1>
@foreach( $applications as $application)
    <p>{{ $application->user_id }}</p>
@endforeach

@foreach( $users as $user)
    <p>{{ $user }}</p>
@endforeach