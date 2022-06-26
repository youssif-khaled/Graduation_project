

          <!DOCTYPE html>
<html lang="en">
  <head>
  <base href="public">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../public/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../public/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../public/admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../../public/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../public/admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../../public/admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../public/admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../public/admin/assets/images/favicon.png" />
  </head>

  @include('admin.sidebar')
  @include('admin.navbar')

  <body>



    <div class="container-fluid page-body-wrapper">

    <div class="container" align = "center">

        <div class="raw" style="padding: 50px">
          <div style="margin-bottom: 20px ">  <img src="{{ asset('admin/assets/images/download.png') }}" style="border-radius:50% " alt=""> </div>
          @if ( session()->has('created')  || session()->has('validation') || session()->has('validation'))
          <div class="alert alert-dismissable alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <strong>
                  {!! session()->get('created') !!}
                  {!! session()->get('validation') !!}
                  {!! session()->get('found') !!}
              </strong>
          </div>
       @endif
       <form method="POST" action="{{ url("update/$user->id") }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="exampleInputEmail1">ID</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Id" value="{{ $user->id }}" name="id">
          <small id="emailHelp" class="form-text text-muted">We'll never share your ID with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Name</label>
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Name" value="{{ $user->name }}" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Department</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Department" value="{{ $user->department }}" name="department">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Meals</label>
            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Meals" value="{{ $user->meals }}" name="meals">
          </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
        </div>
    </div>
    </div>






@include('admin.footer')
