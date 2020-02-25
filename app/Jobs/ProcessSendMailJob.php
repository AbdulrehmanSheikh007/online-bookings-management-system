<?php

namespace App\Jobs;

use App\Mail\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ProcessSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailAddress;
    protected $mail;

    /**
     * ProcessSendMailJob constructor.
     * @param $emailAddress
     * @param $mail
     */
    public function __construct($emailAddress, $mail)
    {
        $this->emailAddress = $emailAddress;
        $this->mail= $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->emailAddress)->send($this->mail);
    }
}
