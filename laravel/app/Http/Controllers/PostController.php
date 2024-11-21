<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function viewSinglePost(Post $post){ // 'post' must match the name we used in route(web.php) as dynamic value
        return view('single-post',['post'=>$post]); //take the specific post as parameter
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
        $newPost=Post::create($incomingFields);

        //when user creates a post,redirect him to the specific post and include a message to dissplay
        return redirect("/post/{$newPost->id}")->with('success','New post created');
    }

    public function showCreateForm(){
        return view('create-post');
    }
}
