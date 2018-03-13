<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\comments;
use App\Reply;
use App\Likes;
use Auth;
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
        $users = User::all();
        $posts = Post::orderBy('created_at', 'desc')->get();
   $reply = Reply::all();

   $like =Likes::all();
   $Allcomments =comments::all();
   

   $likesArray = array();
     foreach ($like as $likes) {
         array_push($likesArray, $likes);
     }

    // return $likesArray;
         return view('home')->with([
         'posts' => $posts, 
         'users' => $users,
         'allcomments'=> $Allcomments,
         'likes'=>$likesArray,
         'commentReply'=> $reply
         ]);
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
    public function store(Request $request)
    {

        $this->validate(
            $request, 
            [
            'body'=>'max:255|nullable',
            'image' => 'nullable'
             ]
        );
        $newPost = new Post();
        if($request-> hasFile('image'))
        { 
            $file = $request->file('image');
            $newPost->image = $request->image->  Storage::put('public/images', $file);;
            //storage::disk('local')->put($file);
          
        }

        $newPost->body = $request->input('body');
        $file = $request->file('image');
        $newPost->user_id = auth::user()->id;
       
        $newPost->save();
        return redirect('/'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
      
        return view('Post')->with(['post' => $post]);
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
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/')->with('success', 'successfully deleted item');
    }

    public function getComments()
    {
     
    }
}
