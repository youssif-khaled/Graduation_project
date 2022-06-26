{{-- <!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.header')
  </head>
  <body>
  @include('admin.sidebar')
      <!-- partial -->

@include('admin.navbar')




          <!-- partial -->
     @include('admin.footer') --}}
     @extends('admin.container')
     @section('content')

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

              </table>
              {!!   $user->links() !!}

        </div>
        <button type="submit" class="btn btn-outline-primary" ><a href="{{ url('addEmployee') }}" style="text-decoration: none">Add Employee</a></button>
        <button type="button" class="btn btn-outline-primary"> Employees: {{ $count->count() }}</button>
    </div>
    </div>

     @endsection
