<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyDigest extends Mailable
{
    use Queueable, SerializesModels;

    public $posts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = User::where('email', '=', request('email'))->first();

        if ($user->is_premium ?? false ){
            $this->posts = Post::latest()
                                ->where("created_at", ">=", Carbon::now()->subWeek()->toDateTimeString())
                                ->get();
        } else {
            $this->posts = Post::latest()
                                ->where("created_at", ">=", Carbon::now()->subWeek()->toDateTimeString())
                                ->where('is_premium', '=', 'false')
                                ->get();
        }
        $this->afterCommit();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.weeklyDigest');
    }
}
