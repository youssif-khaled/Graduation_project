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
                <th scope="col" style=" font-size: 20px">Employee_ID</th>
                <th scope="col" style=" font-size: 20px">Comment</th>
                <th scope="col" style="font-size: 20px">rating</th>
                <th scope="col" style=" font-size: 20px">Created_at</th>
              </tr>
            </thead>
@foreach ($user as $value )

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

    <button type="button" class="btn btn-outline-primary"> Employees: {{ $count->count() }}</button>
    <button type="button" class="btn btn-outline-success"> Average Raings: {{ $sum / $count->count() }} </button>
</div>
</div>


          <!-- partial -->
     @include('admin.footer')
