<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\SetMemberUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('users/create');
    }

    public function signIn()
    {
        return view('users/login');
    }

    public function logout()
    {
    }

    public function register(RegisterUserRequest $request)
    {
        // TODO check :: validatie afhandelen in Request, gedaan voor de hele UserController
        $validated = $request->validated();

        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        return redirect(route('posts.index'));
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            request()->session()->regenerate();

            return redirect(route('user.overview'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logoutuser()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route('posts.index'));
    }

    public function overview()
    {
        return view('users/overview', [
            'posts' => Post::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->get()
        ]);
    }

    public function member()
    {
        return view('users/member', []);
    }

    public function setMember(SetMemberUserRequest $request)
    {
        $validated = $request->validated();

        $user = request()->user();
        $user->is_premium = true;
        $user->save();

        return redirect(route('posts.index'));
    }
}
