<h1>Companie profile</h1>
@foreach( $details as $detail)
    <h1>{{ $detail->name }}</h1>
    <a href="/companies/{{ $detail->id }}/internships">View available internships</a>
@endforeach