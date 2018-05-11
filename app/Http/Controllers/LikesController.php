<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Likes;
use App\Post;
use Auth;
class LikesController extends Controller
{
    
    /**
     * add and remove likes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addLike( $id, $user)
    {   $post_id = Post::find($id);
        $likes = new Likes();
        $likes->post_id = $post_id->id;
        $likes->user_id = $user;

       
// check if user already liked the post
        $liked = Likes::where('user_id', $user)
                        ->where('post_id', $post_id->id)
                        ->first();
        if($liked){
            //remove the like
            $liked->delete();  
              // get all likes by id
         $new_likes = Likes::all();
        return response()->json(['likes' =>$new_likes]);
            
        }
        else{

            // else save the like
            $likes->save();
            $new_likes = Likes::all();
            return response()->json(['likes' =>$new_likes]);
        }
       
        
    }

   

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $post_id = Post::find($id);
            $like = Likes::where('user_id', Auth::id())
            ->where('post_id', $post_id->id)
            ->first();
            $like->delete();
            $likes =Likes::all();
            return $likes;
           
    }
}
