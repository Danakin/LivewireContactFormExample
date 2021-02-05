<?php

namespace App\Http\Livewire;

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

        Mail::to("example@ttg.com")->send(
            new ContactFormMailable(
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->message
            )
        );

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
