 @extends('layouts.master')
 

@include('includes.navbar')

 


   @section('content')  
   @if(Session::has('success'))
  <div class="alert alert-success">
      {{Session::get('success')}}
    </div> 
   @endif

   {{--  side bar  --}}
<div class="col-md-3 sidebar">
    <ul class="list-group">
      <li class="list-group-item">
          News Feed <i class="fa fa-globe"></i>
      </li>
      <li class="list-group-item">
         Radio  <i class="fa fa-newspaper-o"></i>
      </li>
      <li class="list-group-item">
         TV  <i class="fa fa-tv"></i>
      </li>
      <li class="list-group-item">
          Games  <i class="fa fa-gamepad"></i>
       </li>
    </ul>
  </div>
{{--  end-of -sidebar  --}}


   @section('header')
<div class="col-md-12 profile">
 
  @if(Auth::Check())
    <h4 class="username"> {{Auth::user()->name}} </h4>
 
  <img src="{{asset('images/'.Auth::user()->profile_Image )}}" class="thumbnail img-responsive" alt="">
  @endif
</div>
   @endsection

   {{--  create post   --}}
   @include('includes.createPost')
   {{--  end of create post  --}}
   
   {{--  side bar right trending  --}}
<div class="col-md-3 panel panel-default">
    <div class="panel-heading">
      TRENDING
    </div>
    <div class="panel-body">
      <li class="bg-info">
        user 2 posted
      </li>

      <li class="bg-info list-group-item">
          user 2 posted
        </li>

        <li class="bg-info">
            user 2 posted
          </li>
    </div>
  </div>
  {{--  end-of-side bar right  --}}

  {{--  online status  --}}
  <div class="col-md-3  stautsContainer">
  <div class="col-md-3  online_status">
    <h3 class="status text-center">Online Status</h3>
    @foreach ($users as  $user)
   
    @if($user->online())
    <li class="list-group-item">
      @if(Auth::user()->id === $user->id)
      
      <a href="{{route('user.profilebyId', $user->id)}}">
      <img src="{{asset('images/'.$user->profile_Image)}}"  class="img-circle " width="30px" height="30px" alt="">
    </a>
      {{$user->name}} - (me) <span class="badge success">online</span>
        @else
      
      <a href="{{route('user.profilebyId', $user->id)}}">
              
        <img src="{{asset('images/'.$user->profile_Image)}}"  class="img-circle " width="30px" height="30px" alt="">
      </a> 
        {{$user->name}} <span class="badge success">online</span>

        @endif
      </li>
   @else
   <li class="list-group-item">
      <a href="{{route('user.profilebyId', $user->id)}}">     
      <img src="{{asset('images/'.$user->profile_Image)}}"  class="img-circle " width="30px" height="30px" alt="">
      </a>
      {{$user->lastseen()}}
   {{$user->name}} <span class="badge default">offline</span>

   </li>
    @endif  
    @endforeach
  </div>
</div>

<div id="app">
    <example-component></example-component>
    <home-component></home-component>
    
</div>



 
 @endsection

 



 

