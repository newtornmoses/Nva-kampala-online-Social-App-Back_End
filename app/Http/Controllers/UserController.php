<?php
 namespace  App\Http\Controllers;

        use Illuminate\Http\Request;
        use App\User;
        use  App\Post;
        use Auth;
        class UserController extends Controller
        {

      

            /** 
             * 
             *
             *
             * @Get all users
             * @return allusers
             */
            public function getUsers()
            {
                $users = User::all();
                
                return view('home')->with('users', $users);
            
            }
                    //get signup Form
            public function index()
            {
                    return view('signup');
            }

        // get userProfile
        public function Userprofile()
            {
                $userArray = array();
                $user = Auth::user()->posts;
                foreach(  $user as $post):
                array_push($userArray, $post);
                endforeach;

                // sort the array
              usort($userArray, function ($a, $b ) {
                  return $a->id < $b->id;
                });
           
               
                return view('Userprofile')->with('posts', $userArray);
            }

            //get userprofile by id

            public function UserprofileId($id)
            {
                $userArray =array();
            $userbyId = User::find($id)->posts;
          foreach ($userbyId as $user):
             array_push($userArray, $user);
          endforeach;

            usort($userArray, function($a, $b){
                return $a->id < $b->id;
            });

            return view('UserprofileId')->with('posts', $userArray);
            }


        //store Users
        public function registerUser(Request $request)
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
            Auth::login($newUser);
            return redirect('/');
            
        }


        //get userlogin Form
        public function getlogin()
        {
            return view('login');
            
        }

        //login user
        public function login(Request $request)
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password'=> 'required|min:6'
            ]);
        
            if(Auth::attempt(['email' => $request->input('email'), 'password' =>$request->input('password')]))
            {
            return redirect('/')->with('success', 'successfully logged in');
            }
            $danger ='please check your credentials';
            return redirect()->back()->with(['danger'=> $danger]);
            
        }
        

        //log out user
        public function logout()
        {  
            Auth::logout();
            
            return view('login');
        }


        }
