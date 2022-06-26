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
                <th scope="col" style=" font-size: 20px">Employee_ID</th>
                <th scope="col" style="font-size: 20px">Created_at</th>
                <th scope="col" style="font-size: 20px">Meals</th>
                <th scope="col" style=" font-size: 20px">Status</th>
              </tr>
            </thead>
@foreach ($user as $value )

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

          </table>
          {!!   $user->links() !!}

    </div>

    <button type="button" class="btn btn-outline-danger"> Meals Done: {{ $sum }}</button>
    <button type="button" class="btn btn-outline-primary"> Employees: {{ $count->count() }}</button>
    <button type="button" class="btn btn-outline-success"> <a href="{{ url('export') }}" style="text-decoration: none">Excel</a> </button>
</div>
</div>


          <!-- partial -->
     @include('admin.footer')
