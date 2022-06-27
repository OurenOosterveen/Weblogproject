<?php

namespace App\Http\Controllers;

use App\Mail\WeeklyDigest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send() {
        request()->validate([
            'email' => 'required|email'
        ]);

        Mail::to(request('email'))->send(new WeeklyDigest());

        return redirect(route('posts.index'));
    }
}
