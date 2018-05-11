<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\comments;
use App\Post;
class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $comment = comments::all();

       return $comment;
    }

    public function _construct()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request, $id, $user)
    {
        $this->validate($request, [
            'comment'=> 'required|max:220',
            ]
        );

    

        $post = Post::find($id);

        $comment = new comments();
        $comment->comment=$request->input('comment');
        $comment->user_id =$user;
        $comment->post_id =$post->id;
        $comment->reply_id=0;
        $comment->save();

        // fetch all comments 
        $allcomments =  comments::all();
        return response()->json($allcomments);
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
