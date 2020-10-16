<h1>Internship details</h1>
@foreach( $details as $detail)
    <p>{{ $detail->title }}</p>
    <p>{{ $detail->description }}</p>
    <p>{{ $detail->tasks }}</p>
@endforeach