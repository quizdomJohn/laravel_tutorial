<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function actuallyUpdate(Post $postToSaveEdit,Request $request){
        $incomingFields = $request->validate([
        'title'=>'required',
        'body'=>'required'
    ]);
    // prevent from malicious html content
    $incomingFields['title']=strip_tags($incomingFields['title']);
    $incomingFields['body']=strip_tags($incomingFields['body']);    

    $postToSaveEdit->update($incomingFields);  // save the new data to database
    return redirect("/post/$postToSaveEdit->id")->with("success","Your post was successfully updated!");}


    public function showEditForm(Post $postToEdit){
        return view('edit-post',['post'=>$postToEdit]);
    }

    public function deletePost(Post $postToDelete){
    //!  this condition was for the first way of deleting
    //    if (auth()->user()->cannot('delete',$postToDelete)) { // if the loggedin user can not delete the specific post
    //     return 'You can not delete it';
    //    }
    //!  ==================  end  ===================

       $postToDelete->delete(); // delete the specific post
       return redirect('/profile/' . auth()->user()->username)->with('success','Post deleted!!!');
    }

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
