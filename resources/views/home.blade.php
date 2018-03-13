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



  {{--  all posts  --}}
<div class="col-md-8 col-md-offset-1">
    <h2 class="text-center Homeheading"> Recent Stories</h2>
        @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="homePosts">
    
       
     <div class="panel">
        <div class="userInfo">
       
        <span> 
         <a href={{route('user.profilebyId', $post->user->id)}}>
           <img src="{{asset('images/'.$post->user->profile_Image)}}"  class="img-circle " width="50px" height="50px" alt="">
          </a>
          
        </span>
        <h4 class="user"> {{$post->user->name}}</h4> 
  
      </div>
            <p>{{$post->body}}</p>
            <a href="{{route('post.show', $post->id)}}">
                
            <img src="{{asset('/images/'.$post->image)}}" class="img-responsive " alt="">
          </a>
            <div class="Postcontrols">
                <div class="likes">
                
                    <form action="{{route('post.likes', $post->id)}}" method="post">
                     
                  
                     @foreach($likes as $like)
              
                      @if($post->id === $like->post_id)
                     {{$like->user->name}}
                    
                     @endif   
                     @endforeach
                     <i class="fa fa-thumbs-up  text-primary">
                         <button type="submit">     {{count($post->likes)}} Like</button></i>
                         {{csrf_field()}}
                     </form>
              </div>


              <div class="comment">
                <i class="commentIcon text-primary">
                  comment </i>
                  <img src="images/comment.png" class="commentBox" width="40" height="24"  alt="">

              </div>
        
              <div class="share">
                <i class="fa fa-reply  text-primary"> share</i>
              </div>
        
              <div class="time">
                Posted : {{$post->created_at->diffForHumans()}}
              </div>
              </div>

              <form action="{{route('post.comment', $post->id)}}" class="commentForm" method="post">
                <div class="comment_row">
               <img src="{{'images/'.$post->user->profile_Image}}"  class="img-circle img-responsive commentpic" style="width:30px; height:30px;" alt="">
              
               <input type="text" class="form-control commentField" name="comment" id="comment" placeholder="{{$post->user->name .' say something'}}" >
             
               {{csrf_field()}}
              </div>
              </form>
           @if (count($post->comments)>0)
           <h4>Comments <span class="badge">{{count($post->comments)}}</span></h4>
            
              <div class="commentsField">
                <ul>
                
                    @foreach ($post->comments as $comment)
                    
                     <li class="commentSection">
                      <div class="singleComment">
                       <div class="user">
                        <img src="{{'images/'.$comment->user->profile_Image}}"  class="img-circle img-responsive commentpic" style="width:30px; height:30px;" alt="">
                        <p class="commentUser">{{$comment->user->name}}</p>
                      </div>
                      <p class="actualComment">{{$comment->comment}} <i class="fa fa-clock-o "> <span class="badge"> {{$comment->created_at->diffForHumans()}}</span></i></p>

                    </div>
                      <div class="Replycontrols">
                          <div class="likes">
                           <i class="fa fa-thumbs-up  text-primary">Like</i>
                            
                        </div>
                       
                  
                        <div class="replybtn">
                          <i class="fa fa-reply  text-primary"> reply</i>
                        </div>
                     
                  
                      
                        
                          
              <form action="{{route('post.reply', $comment->id)}}" class="col-md-6 replyForm" method="post">
                  <div class="comment_row col-md-6">
                 {{--  <img src="{{'images/'.$post->user->profile_Image}}"  class="img-circle img-responsive commentpic" style="width:30px; height:30px;" alt="">
                  --}}
                 <input type="text" class="form-control" name="reply" id="reply" placeholder="{{Auth::user()?Auth::user()->name.' type your reply': ' '  .'  type your reply '}}" >
               
                 {{csrf_field()}}
                </div>
                </form>
                
                      </div>
                    

                     <div class="replies">
                     
                      <div class="viewmore">
                          <a class="viewLess btn btn-info"><i class="fa fa-caret-up"></i> view less</a>
                        <a class="viewReplies btn btn-primary"><i class="fa fa-caret-up"></i> view all replies</a>
                      </div>
                       @foreach ( $commentReply as $reply )
                       @if($reply->comment_id === $comment->id)
                   
                       <ul class="reply-group">
                       
                        <li class="replyText">
                    {{$reply->reply}}  <span class="badge reply"> 
                      
                      <img src="{{asset('images/'.$reply->user->profile_Image)}}" class="img-circle" width="30px" height="30px" alt="">
                      {{$reply->user->name}}</span> <span>
                        {{$reply->created_at->diffForHumans()}} 
                      </span>

                      
                       </ul>

                       <div class="Replycontrols">
                          <div class="likes">
                          <i class="fa fa-thumbs-up  text-primary"> Like</i>
                        </div>
                       
                  
                        <div class="share">
                          <i class="fa fa-reply  text-primary"> reply</i>
                        </div>
                      </div>
                   
                   
                       @endif
                       
                        @endforeach
                        
                      </div>
                    </li>
                  
                     @endforeach 
                 
                 
                 
                </ul>
              
              </div>
           

              @else
            <h5>No comments</h5>

           @endif
              
            </div>
        </div>
      
      
        @endforeach
   @endif 
  
  </div>
 @endsection

 

