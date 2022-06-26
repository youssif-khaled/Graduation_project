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

        <div class="raw" >

        <!-- partial -->
        @if (session()->has('message') || session()->has('created') ||session()->has('error') || session()->has('attention') )
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {!! session()->get('message') !!}
                {!! session()->get('created') !!}
                {!! session()->get('error') !!}
                {!! session()->get('attention') !!}
            </strong>
        </div>
     @endif

        <form method="POST" action="{{ url('addEmployee') }}">

            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">ID</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Id" name="id">
              <small id="emailHelp" class="form-text text-muted">We'll never share your ID with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Name" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Department</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Department" name="department">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Meals</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Meals" name="meals">
              </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit"   class="btn btn-outline-primary"><a style="text-decoration: none" href="{{ url('/showUsers') }}">Back</a></button>
          </form>



    </div>

</div>

</div>


          <!-- partial -->
     @include('admin.footer')
