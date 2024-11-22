<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile(User $userProfile){ // 'userProfile' name should match the name the the dynamic route has in web.php
        // return $userProfile;
        $thePosts=$userProfile->postsCustomFunction()->get(); // getting the posts of the user
        // return $thePosts;
        return view('profile-posts',['username'=>$userProfile->username,'posts'=>$userProfile->postsCustomFunction()->latest()->get()]); // passing the posts as parameter to use them to html template
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','You just logged out'); // 'success' is a name of our choice
    }

    public function showCorrectHomepage(){
        if (auth()->check()) { // if user is logged in
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    public function login(Request $request){
        $incomingFields=$request->validate([
            'loginusername'=>'required', //. loginusername is the name that the input has in the html
            'loginpassword'=>'required' //. loginpassword is the name that the input has in the html
        ]);

        // check if the user exists
        if (auth()->attempt(['username'=>$incomingFields['loginusername'],'password'=>$incomingFields['loginpassword']])){
            $request->session()->regenerate(); // so the user stays logged in (check cookies)
            return redirect('/')->with('success','You just logged in'); // 'success' is a name of our choice
        }else{
            return redirect('/')->with('failure','Invalid credentials'); // 'failure' is a name of our choice
        }
    }

    public function register(Request $request){ // we are taking the incoming data that submitted in the form
        $incomingFields = $request->validate([ //to make the fields required in order to submit it
            'username'=>['required','min:3','max:20',Rule::unique('users','username')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:8','confirmed'],
        ]);

        // before saving the inputs to the database,we need to hash the password
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        
        $user=User::create($incomingFields); // we use the User model in order to save the inputs data in the database
        auth()->login($user); //in order to make the user loggedin when he registers
        return redirect('/')->with('success','You maaadeee iiiit!!!!');
    }
}
