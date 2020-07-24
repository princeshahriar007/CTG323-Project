<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(){
        $this->validate(request(),[
            'comment' => 'required'
        ]);

        Comment::create([
            'comment' => request('comment'),
            'user_id' => Auth::id(),
            'post_id' => request('post_id')
        ]);


        return redirect()->back();
    }

    public function delete($id){
        $comment = Comment::find($id);
        if(Auth::id() == $comment->user->id){
            $comment->delete();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
