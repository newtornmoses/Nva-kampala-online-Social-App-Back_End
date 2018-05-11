<?php

namespace App\Http\Controllers;

use App\User;
use carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup', 'updateCover', 'show']]);
    }



    //register  Users
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required| min:4',
            'email'=> 'required| email|unique:Users',
            'password' => 'required| min:6'
        ]);

        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = bcrypt($request->input('password'));
        $newUser->profile_image = $request->input('profile_image');
       
        

        $newUser->save();
        $newUser ->update([
            'slug' => '@'.str_slug($newUser->name, '_').'_'.$newUser->id
        ]);
        // Auth::login($newUser);
        if($newUser) {
            $token = auth()->login($newUser);
        return response()->json(['success', $token,'auth'=>Auth::user()]);
        }else {
        return response()->json('an error occured');
            
        }
       
        
    }

    // logged in user
    public function user() 
    {
        return  response()->json(Auth::user());
    }

    // single user
    public function show($id) {
        return response()->json(User::find($id));
    }
      

    //update cover Image
    public function updateCover(Request $request ,$id)
    {  
       $file_data = $request->input('cover_image'); 

        $file_name = 'image_'.time().'.png'; //generating unique file name; 
                 // storing image in storage/app/images/cover Folder 
             Storage::put('public/images/cover/'.$file_name,  base64_decode($file_data));
           
                    // find user and update
        $user = User::find($id); 
          $user->cover_image =  '/storage/images/cover/'.$file_name;
          $updated= $user->save();
            if ( $updated) {
                $updated_user = User::find($id);
                return response() ->json($updated_user);
                
            }
        


    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // return $this->respondWithToken([$token, 'user'=>Auth::user()]);
        return response()->json(['token'=>$token, 'user'=>Auth::user()]);
        

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout(true);

        return response()->json(['message' => 'Successfully logged out']);
    }

    
}