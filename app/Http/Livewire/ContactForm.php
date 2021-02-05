<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $message;

    public function updated($propertyName) {
        $this->validateOnly($propertyName, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email:rfc,dns'],
            'message' => ['required', 'min:4']
        ]);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
