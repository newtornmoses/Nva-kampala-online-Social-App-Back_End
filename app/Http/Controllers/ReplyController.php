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
    public function store(Request $request , $id)
    {  
        $comment_id = comments::find($id);
       $reply = new Reply();
       $reply->reply = $request->input('reply');
       $reply->user_id= Auth::id();
       $reply->comment_id =$comment_id->id;
       $reply->save();
       
   
       $comment_id->update([
           'reply_id' => $reply->id
       ]);

       return redirect()->back();

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
