<?php

namespace App\Console\Commands;

use App\Mail\WeeklyDigest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeeklyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:senddigest {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a compilation of the post writen in the last 7 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to($this->argument('email'))->send(new WeeklyDigest());
    }
}
