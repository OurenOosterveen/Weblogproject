<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
