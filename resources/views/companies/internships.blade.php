<h1>Available internhips profile</h1>
@foreach( $internships as $internship)
    <h1>{{ $internship->title }}</h1>
    <a href="/companies/{{ $internship->company_id }}/internships/{{ $internship->id }}">View internship</a>
@endforeach