<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function viewSinglePost(){
        return view('single-post');
    }


    public function storeNewPost(Request $request){
        $incomingFields = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        // prevent from malicious html content
        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        // to find the author of the post
        $incomingFields['user_id']=auth()->id();
        // save the new post to database
        Post::create($incomingFields);

        return 'Hey!';
    }

    public function showCreateForm(){
        return view('create-post');
    }
}
