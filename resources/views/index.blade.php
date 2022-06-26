{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form >
    @csrf
    <input type="text" name="email">
    <input type="text" name="password">
    <button type="submit" name="submit">login</button>
    <p>dashboard</p>
</form> --}}
@extends('admin.header')
<body>

        <div class="container" align = "center">
            <div class="raw" style="padding: 50px">
              <div style="margin-bottom: 20px ">  <img src="{{ asset('admin/assets/images/download.png') }}" style="border-radius:50% " alt=""> </div>
              @if ( session()->has('message') || session()->has('fill'))
              <div class="alert alert-dismissable alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>
                      {!! session()->get('message') !!}
                      {!! session()->get('fill') !!}
                  </strong>
              </div>
           @endif
<form method="POST" action="{{ url("/login") }}">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1" style="font-size: 20px">Email address</label>
      <input type="text" name="email" class="form-control" style="width:50%;border-radius: 10px" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" style="font-size: 20px">Password</label>
      <input type="password" name="password" style="width:50%;border-radius: 10px;" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
            </div>
        </div>

</body>
</html>
@extends('admin.footer')
