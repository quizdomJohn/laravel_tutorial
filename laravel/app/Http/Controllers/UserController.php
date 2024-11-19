<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){ // we are taking the incoming data that submitted in the form
        $incomingFields = $request->validate([ //to make the fields required in order to submit it
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        User::create($incomingFields); // we use the User model in order to save the inputs data in the database
    }
}
