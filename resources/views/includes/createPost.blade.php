 {{--  whats on your mind  --}}
 <div class="col-md-6 createForm">
        <form action="{{route('post.post')}}"  class="uploadform"  enctype="multipart/form-data" method="post">
            <div class="form-group">
               <textarea name="body" class="form-control" cols="30" rows="10" placeholder="Say something ..."></textarea>
               </div>
               <div class="uploadTypes">
                    <i class="fa fa-camera upload" > Camera </i>
                    <i class="fa fa-photo upload" > Photo</i>
                    <i class="fa fa-video-camera upload"> Video</i>
                    <i class="fa fa-microphone upload"> Audio</i>
               </div>
               
            
               <div class="form-group">
                <input type="file" name="image" class="form-control postfileUpload" >
                </div>
                <hr>
               <input type="submit" class ="btn btn-warning col-md-offset-4" value="Say something">
              
               {{csrf_field()}}
           
            </form>

            <div class="modal fade" id="captureVideo">
                <video class="video"></video>
                <canvas class="canvas"></canvas>
            </div>


 </div>

 <script src="{{asset('js/scripts.js')}}"></script> 
 <script src="{{asset('js/camera.js')}}"></script> 
 {{-- <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script> --}}
 

 