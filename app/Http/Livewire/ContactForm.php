<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $message;

    public function render()
    {
        return view('livewire.contact-form');
    }
}
