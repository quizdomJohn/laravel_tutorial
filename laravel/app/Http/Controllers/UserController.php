<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/');
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
            return redirect('/');
        }else{
            return 'You are not logged in!!!!';
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
        
        User::create($incomingFields); // we use the User model in order to save the inputs data in the database
    }
}
