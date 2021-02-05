<?php

/**
 * Alternative to Mail::to()->queue() by Invoking SendEmail::dispatch();
 * This is a case of DRY but I left it in for completion.
 * This class is not called in the current setup.
 */

namespace App\Jobs;

use App\Mail\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $email;
    public $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $first_name = "",
        $last_name = "",
        $email = "",
        $body = ""
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ContactForm(
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->body
        );
        Mail::to("example@ttg.com")->send($email);
    }
}
