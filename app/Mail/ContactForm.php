<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $email;
    public $body;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.contact-form")->from($this->email);
    }
}
