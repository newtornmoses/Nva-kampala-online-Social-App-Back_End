<?php
 
namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use App\Likes;
use App\Reply;
use App\comments;
use carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

   /**
    *  Post controller 
    *
    *
    * @return \Illuminate\Http\Response
    */

class PostController extends Controller
{

    // auth middleware
    // public function __construct()
    // {
    //     return $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $userAll = User::all();
    
       
        return $userAll;
        
        if(!Auth::check()){
            return response('not logged in');
        }
        $users = User::all();
       $posts = Post::orderBy('created_at', 'desc')->get();
   

         return view('home')->with('users', $users);
    }

    // json feed

    public function jsonIndex()
    { 
        
        
        $users = User::all();
       $posts = Post::orderBy('created_at', 'desc')->get();
    //    $logged_in = User::find(Auth::user()->id);
  
         return response()->json(['posts' => $posts, 'users' => $users , 'user'=>Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    { 
        

        $this->validate(
            $request, 
            [
            'body'=>'max:255|nullable',
            'file' => 'nullable',
            'mime_type' =>'nullable'
             ]
        );
            
   
     if ($request->body === 'undefined' &&  $request->file('file') === 'undefined' ) {
         return response()->json('please check your uploads');
     }
     
    if ($request->body !== 'undefined') {
        $body = $request->body;

    }else {
        $body = null;
        
    }
    

       
            if ( $request->hasFile('file')) {
                $file =str_slug(Carbon::now(), '-').$request->file('file')->getClientOriginalName();
                $newName =  '/storage/images/'.$file;  
              $request->file->storeAs('public/images', $file); 
          
              
  
          
            
          
          // check form mime type
          $filetype =$request->file('file')->getClientMimeType();
        
          if($filetype ==='image/jpeg' ||$filetype ==='image/gif' ||  $filetype ==='image/jpg'  ||  $filetype ==='image/JPG' ||  $filetype ==='image/png' )
          {
           $mime_type = 'image';
              

          }
          elseif ($filetype ==='video/mp4' ||$filetype ==='video/mpg'||$filetype ==='video/mpeg'  ||  $filetype ==='video/webm' ||  $filetype ==='video/ogg'){
              
              $mime_type = 'video';
          }
      


                 
           
              //save post
            $post = Post::create([
                'file' =>$newName,
                'mime_type' =>$mime_type,
                 'user_id' => $user,
                 'body' =>$body 

            ]);
            return response()->json( $post); 
            }
            else{
            
       
          //save post
        $post = Post::create([
            'file' =>NULL,
            'mime_type' =>NULL,
             'user_id' => $user,
             'body' =>$body 

        ]);
        return response()->json( $post); 
            }

       

  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = User::where('slug', $slug)->first()->posts;
      
        return response()->json(['posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
         $post = Post::find($id);
        $post->body = $request->input('body');
        $post->image = $request->input('image');
        $post->save();
        return view('Post')->with('post', $post);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user)
    {
        $post = Post::where('id', $id)
                                 ->where('user_id', $user)->first();
     $deleted =   $post->delete();
     if ($deleted) {
        return response()->json('successfully deleted item');

     }
     return response()->json('some thing wrong happend try again!!');
     
    }

    public function getComments()
    {
     
    }
}
