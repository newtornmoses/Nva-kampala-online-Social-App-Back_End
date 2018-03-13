@extends('layouts.master')

@section('content')
<div class="col-md-6 col-md-offset-3">
@if(count($errors)>0)
  @foreach ($errors->all() as $error )
      <div class="alert alert-danger">
          <h4>{{$error}}</h4>
      </div>
  @endforeach
@endif

<div class="danger">
        @if(Session::has('danger'))
       
            <div class="alert alert-danger">
                <h4>{{Session::get('danger')}}</h4>
            </div>
       
      @endif
</div>
</div>
<h4 class="col-md-6 col-md-offset-3 text-center">
    Login
</h4>
<form action="{{route('user.login')}}" class="col-md-6 col-md-offset-3"     method="post">
    
    <div class="form-group">
            <label for="Username">Email:</label>
            <input type="text" name="email"  class="form-control"  placeholder=" your email here" >
        </div>

    <div class="form-group">
            <label for="email">Password:</label>
            <input type="password" name="password" class="form-control"  placeholder="your password here" >
    </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" class="form-control" >Login</button>
            {{csrf_field()}}
            </div>

</form>

@endsection