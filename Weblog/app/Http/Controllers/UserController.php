<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create () {
        return view('users/create');
    }

    public function signIn() {
        return view('users/login');
    }

    public function logout() {

    }

    public function register() {
        $attr = request()->validate([
            'username' => 'required|unique:users,username|min:5|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|max:21',
            'password_confirmation' => 'required'
        ]);

        $user = new User([
            'username' => $attr['username'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password'])
        ]);

        $user->save();

        return redirect(route('posts.index'));
    }

    public function login() {
        $credentials = request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
 
            return redirect(route('user.overview'));
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logoutuser() {
        Auth::logout();

        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
     
        return redirect(route('posts.index'));
    }

    public function overview() {
        return view('users/overview', [
            'posts' => Post::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->get()
        ]);
    }

    public function member() {
        return view('users/member', [

        ]);
    }

    public function setMember() {
        request()->validate([
            "confirm" => "required"
        ]);

        $user = request()->user();
        $user->is_premium = true;
        $user->save();

        return redirect(route('posts.index'));
    }
}
