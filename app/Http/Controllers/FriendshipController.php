<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\friendship;
use App\User;
use Auth;
class FriendshipController extends Controller
{
    /**
     * add friend.
     *
     * 
     */
    public function addfriend($reciever, $id)
    {
      return User::find($id)->sendFriendRequest($reciever);
        
    }

    /**
     * confirmfriend req.
     *
     * 
     */
    public function confirmfriend()
    {
        //
    }

    /**
     * 
     *
     * friend status
     * 
     */
    public function status($reciever, $user_id)
    {
       return User::find($user_id)->status($reciever, $user_id);
    }

    /**
     * cancle request sent
     *
     * 
     * 
     */
    public function canclefriend($reciever, $user_id)
    {
        return User::find($user_id)->cancle($reciever , $user_id);
    }

    /**
     * get pending requests
     *
     * 
     * 
     */
    public function pending($user_id)
    {
        return User::find($user_id)->pendingFriends();
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
