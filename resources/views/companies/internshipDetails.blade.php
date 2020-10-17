@include('partials.header')
<h1>Internship details</h1>
@foreach( $details as $detail)
    <p>{{ $detail->title }}</p>
    <p>{{ $detail->description }}</p>
    <p>{{ $detail->tasks }}</p>
@endforeach
<h1>Applications for this internship</h1>
@foreach( $users as $user)
    <p>{{ $user[0]->first_name }}</p>
@endforeach
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
@include('partials.footer')