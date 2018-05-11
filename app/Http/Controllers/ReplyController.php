<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\comments;
use App\Post;
use App\Reply;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cmtid = comments::find($id);
        // $comment = Reply::find($cmtid->id);
         
        $newreply = DB::table('replies')
          ->Join( 'comments', 'replies.comment_id',  '=','comments.id' )
        //   ->Join('users', 'users.id', '=', 'replies.user_id')
          ->get();

          $replies = Reply::all();
        return $replies;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id, $user)
    {  
        $comment_id = comments::find($id);
       $reply = new Reply();
       $reply->reply = $request->input('reply');
       $reply->user_id= $user;
       $reply->comments_id =$comment_id->id;
       $reply->save();
       
   
       $comment_id->update([
           'reply_id' => $reply->id
       ]);
       // get  all replies for the comment
          $commentReplies = Reply::where('comments_id', $id)->get();
                                                      


       return  response()->json($commentReplies);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
