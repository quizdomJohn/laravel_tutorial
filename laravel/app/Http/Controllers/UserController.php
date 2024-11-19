<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){ // we are taking the incoming data that submitted in the form
        $incomingFields = $request->validate([ //to make the fields required in order to submit it
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
    }
}
