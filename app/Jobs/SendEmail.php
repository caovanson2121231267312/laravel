<?php

namespace App\Jobs;

use App\Mail\SendMailToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $mailData, $user;

    public function __construct($mailData, $user)
    {
        $this->mailData = $mailData;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // sleep(30);

        Mail::to($this->user->email)->send(new SendMailToUser($this->mailData));
    }
}
