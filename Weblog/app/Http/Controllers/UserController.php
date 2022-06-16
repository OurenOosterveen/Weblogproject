<?php

namespace App\Http\Controllers;

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
}
