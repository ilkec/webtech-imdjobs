<h1>All companies</h1>
@foreach( $companies as $company)
    <a href="/companies/{{ $company->id }}">{{ $company->name }}</a>
@endforeach