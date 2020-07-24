<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\User;
use App\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function about(){
        return view('guest.about');
    }

    public function blogs(){
        return view('guest.blogs');
    }

    public function projects(){
        return view('guest.projects');
    }

    public function showLogin(){
        return view('guest.login');
    }

    public function login(){
        $this->validate(request(),[
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['name' => request('name'), 'password' => request('password'), 'role' => 'user', 'verified' => 1])){
            return redirect('/');
        }else if(Auth::attempt(['name' => request('name'), 'password' => request('password'), 'role' => 'moderator', 'verified' => 1])){
            return redirect()->route('admin.dashboard');
        }else if(Auth::attempt(['name' => request('name'), 'password' => request('password'), 'role' => 'admin', 'verified' => 1])){
            return redirect()->route('admin.dashboard');
        }else{
            return 'Credentials do not match';
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function ShowRegister(){
        return view('guest.register');
    }

    public function register(){
        $this->validate(request(),[
            'name'=>'required|alpha_dash|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:4|confirmed',

        ]);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'verified' => 0,
            'role' => 'user'
        ]);


        $token = Verify::create([
            'token' => md5(uniqid()),
            'user_id' => $user->id
        ]);

        //dd($user);
        //data is stored in json format in the variable
        Mail::to(request('email'))->send(new SendMail($token->token));

        //Creates one-time session
        return redirect('/')->with('regSuccess', 'User Registered');
    }

    public function verify($token){
        $result = Verify::where('token', $token)->get();
        if(count($result) >= 1){
            $result = $result->first()->user_id;
            User::find($result)->update([
                'verified' => 1
            ]);
            return redirect('/')->with('verifySuccess', 'Email Verified');
        }else{
            return 'Invalid Request Try Again';
        }
    }
}
