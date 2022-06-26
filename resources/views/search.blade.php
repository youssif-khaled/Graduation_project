<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.header')
  </head>
  <body>
  @include('admin.sidebar')
      <!-- partial -->

@include('admin.navbar')

<div class="container-fluid page-body-wrapper">
    <div class="container" align = "center">
        <div class="raw">
        <!-- partial -->

        <table class="table">
            <thead>
              <tr style="text-align: center; font-size: 30px">
                <th scope="col" style=" font-size: 20px">ID</th>
                <th scope="col" style="font-size: 20px">Name</th>
                <th scope="col" style=" font-size: 20px">Employee_Department</th>
                <th scope="col" style=" font-size: 20px">Meals</th>
                <th scope="col" style=" font-size: 20px">Edit</th>
                <th scope="col" style=" font-size: 20px">Delete</th>
              </tr>
            </thead>
@foreach ($user as $value )

            <tbody>
              <tr style="text-align: center">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->department }}</td>
                <td>{{ $value->meals }}</td>

                <td> <button type="button" class="btn btn-outline-primary"> <a href="{{ url("editEmployee/$value->id" ) }}" style="text-decoration: none">Edit</a></button></td>
                <form method="POST" action="{{ url("deleteEmployee/$value->id") }}">
                    @csrf
                    @method('DELETE')
                <td> <button type="submit" class="btn btn-outline-danger">Delete</button></td>
            </form>
              </tr>

            </tbody>
            @endforeach

            <thead>

                <tr style="text-align: center; font-size: 30px">

                    <th scope="col" style=" font-size: 20px">ID</th>
                <th scope="col" style=" font-size: 20px">Employee_ID</th>
                <th scope="col" style="font-size: 20px">Created_at</th>
                <th scope="col" style="font-size: 20px">Meals</th>
                <th scope="col" style=" font-size: 20px">Status</th>
                </tr>
              </thead>
              @foreach ($employee as $value )

            <tbody>
              <tr style="text-align: center">
                <td>{{ $value->id }}</td>
                <td>{{ $value->employee_id }}</td>
                <td>{{ $value->created_at}}</td>
                <td>{{ $value->Employee->meals }}</td>
                <td>{{ $value->status }}</td>

              </tr>

            </tbody>
            @endforeach

            <thead>
                <tr style="text-align: center; font-size: 30px">
                  <th scope="col" style=" font-size: 20px">Employee_ID</th>
                  <th scope="col" style=" font-size: 20px">Comment</th>
                  <th scope="col" style="font-size: 20px">rating</th>
                  <th scope="col" style=" font-size: 20px">Created_at</th>
                </tr>
              </thead>
  @foreach ($rating as $value )

              <tbody>
                <tr style="text-align: center">
                  <td>{{ $value->employee_id }}</td>
                  <td>{{ $value->comment}}</td>
                  <td>{{ $value->rating }}</td>
                  <td>{{ $value->created_at }}</td>

                </tr>

              </tbody>
              @endforeach

          </table>
          {!!   $user->links() !!}

    </div>
    <button type="button" class="btn btn-outline-primary"> Meals Done: {{ $sum }}</button>
    {{-- <button type="button" class="btn btn-outline-primary"> Employees:{{ $count->count() }}</button> --}}
</div>
</div>

<br>

          <!-- partial -->
     @include('admin.footer')
