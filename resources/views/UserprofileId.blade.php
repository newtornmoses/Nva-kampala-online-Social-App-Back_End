
@extends('layouts.master')  
@include('includes.navbar')
@section('content')
<div class="user_posts">
 
  <div class="col-md-8 col-md-offset-2">
    @if(count($posts) > 0)
     @foreach($posts as $post)
     <div class="homePosts">
 
    
  <div class="panel">
     <div class="userInfo">
     
     <span> 
        {{--  <img src="{{asset('images/'.$post->file)}}"  class="img-circle " width="50px" height="50px" alt="">  --}}
        <img src="{{asset('images/'.$post->user->profile_Image)}}"  class="img-circle " width="50px" height="50px" alt="">
        
       
     </span>
    @if(Auth::Check())
     
     <h4 class="user">{{$post->user->name}}</h4> 
     @endif
   </div>
         <p>{{$post->body}}</p>
         <a href="{{route('post.show', $post->id)}}">
          {{-- show video or image --}}
          @if ($post->mime_type ==='video')
          <video src="{{asset($post->file)}}" controls></video>

          @else
          <img src="{{asset($post->file)}}" class="img-responsive " alt="">
          @endif
       </a>
         <div class="Postcontrols">
             <div class="likes">
             <i class="fa fa-thumbs-up  text-primary"> Like</i>
           </div>
           <div class="comment">
             <i class="fa fa-comment "> comment</i>
           </div>
     
           <div class="share">
             <i class="fa fa-reply  text-primary"> share</i>
           </div>
     
           <div class="time">
             Posted on: {{$post->created_at}}
           </div>
           </div>
           <form action="{{route('post.comment', $post->id)}}" method="post">
              <div class="comment_row">
             <img src="{{asset('images/'.$post->user->profile_Image)}}"  class="img-circle img-responsive commentpic" style="width:30px; height:30px;" alt="">
            
             <input type="text" class="form-control" name="comment" id="comment" placeholder="{{$post->user->name .' say something'}}" >
           
             {{csrf_field()}}
            </div>
            </form>
         </div>


        
        
   

    <div class="commentsField">
      <ul>
      
     
           @foreach ($post->comments as $comment)
           <li class="commentSection">
            <div class="singleComment">
             <div class="user">
               
              <img src={{asset('images/'.$comment->user->profile_Image)}}  class="img-circle img-responsive commentpic" style="width:30px; height:30px;" alt=" {{$comment->user->profile_Image}}">
              <p class="commentUser">{{$comment->user->name}}</p>
            </div>
            <p class="actualComment">{{$comment->comment}}</p>

          </div>
            <div class="Replycontrols">
                <div class="likes">
                <i class="fa fa-thumbs-up  text-primary"> Like</i>
              </div>
             
        
              <div class="share">
                <i class="fa fa-reply  text-primary"> reply</i>
              </div>
        
            
              </div>

           </li>
           
          
           @endforeach 
       
       
       
      </ul>
    </div>
     </div>
   
   
     @endforeach
     @else
     <div class="col-md-12">
      
           
     
       <h2 style="margin-top:200px">No posts from  user </h2>
       
     </div>
@endif 

</div>
 </div>

 @endsection