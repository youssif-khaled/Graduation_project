
@extends('admin.container')
@section('content')

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
<form method="POST" action="{{ url("/register") }}">
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
<div class="form-group">
<label for="exampleInputEmail1" style="font-size: 20px">Employee_ID</label>
<input type="text" name="employee_id" class="form-control" style="width:50%;border-radius: 10px" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>

<div class="form-group">
<label for="exampleInputEmail1" style="font-size: 20px">Role</label>
<input type="text" name="role" class="form-control" style="width:50%;border-radius: 10px" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>

<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</div>





@endsection




