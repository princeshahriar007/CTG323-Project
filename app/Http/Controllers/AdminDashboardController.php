<?php

namespace App\Http\Controllers;

use App\Image;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function showUser(){
        $users = User::all();
        $userType = ['user', 'moderator', 'admin'];
        return view('admin.users', compact(['users', 'userType']));
    }

    public function changeRole(){
        User::find(request('user_id'))->update([
            'role' => request('role')
        ]);

        return redirect()->back();
    }

    public function disable($id){
        User::find($id)->update([
            'verified' => 0
        ]);

        return redirect()->back();
    }

    public function enable($id){
        User::find($id)->update([
            'verified' => 1
        ]);

        return redirect()->back();
    }

    public function createPostShow(){
        return view('admin.post');
    }

    public function createPost(){
        $this->validate(request(),[
            'title' => 'required',
            'details' => 'required'
        ]);

        User::find(Auth::id())->posts()->create([
            'title' => request('title'),
            'details' => request('details')
        ]);

        return redirect('/admin/posts');
    }

    public function showPost(){
        $posts = Post::latest()->paginate(10);
        return view('admin.postShow', compact('posts'));
    }

    public function showEditPost($id){
        $post = Post::find($id);
        return view('admin.editPost', compact('post'));
    }

    public function editPost($id){
        Post::find($id)->update([
            'title' => request('title'),
            'details' => request('details')
        ]);

        return redirect('/admin/posts');
    }

    public function deletePost($id){
        Post::find($id)->delete();
        return redirect()->back();
    }

    public function showImage(){
        $images = Image::latest()->get();
        return view('admin.image', compact('images'));
    }

    public function uploadImage(Request $r){
        $this->validate(request(),[
            'image' => 'required|image|mimes:jpeg,bmp,png'
        ]);
        $img_name = uniqid().'.jpg';
        $r->image->move('image', $img_name);

        Image::create([
            'image' => $img_name
        ]);

        return redirect()->back();
    }

    public function showOneImage($id){
        $image = Image::find($id);
        return view('admin.imageUpdate', compact('image'));
    }

    public function updateImage(Request $r){
        $this->validate(request(),[
            'image' => 'required'
        ]);

        $image = Image::find(request('id'));
        $img_name = $image->image;
        \Illuminate\Support\Facades\File::delete('image/'.$img_name);

        $new_img = uniqid().'.jpg';
        $r->image->move('image', $new_img);

        $image->update([
            'image' => $new_img
        ]);

        return redirect()->back();
    }
}
