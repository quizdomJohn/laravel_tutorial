<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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