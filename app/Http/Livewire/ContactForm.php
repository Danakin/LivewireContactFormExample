<?php

namespace App\Http\Livewire;

// use App\Jobs\SendEmail; // Used for alternative Queue
use App\Mail\ContactForm as ContactFormMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $message;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email:rfc,dns"],
            "message" => ["required", "min:4"],
        ]);
    }

    public function submit()
    {
        $this->validate([
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email:rfc,dns"],
            "message" => ["required", "min:4"],
        ]);

        // Send the E-Mail directly, just leaving this in to highlight difference, would delete in real application...
        // Mail::to("example@ttg.com")->send();

        // Send the E-Mail to a queue
        Mail::to("example@ttg.com")->queue(
            new ContactFormMailable(
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->message
            )
        );

        // Alternative Method of Queuing using Job App/Jobs/SendEmail
        // In case of E-Mail this is a case of DRY, but I left it in for completion as an example for other queuable jobs (Uploading files to S3 etc.)
        // SendEmail::dispatch(
        //     $this->first_name,
        //     $this->last_name,
        //     $this->email,
        //     $this->message
        // );

        session()->flash("success", "Mail has successfully been sent!");
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->first_name = "";
        $this->last_name = "";
        $this->email = "";
        $this->message = "";
    }

    public function render()
    {
        return view("livewire.contact-form");
    }
}
