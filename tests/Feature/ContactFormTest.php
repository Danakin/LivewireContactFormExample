<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use App\Http\Livewire\ContactForm;
use App\Mail\ContactForm as ContactFormMailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    private $fromEmail = "testuser@test.com";

    public function test_default_route_exists()
    {
        $this->get("/")->assertStatus(200);
    }

    public function test_can_see_livewire_form_component_on_main_page()
    {
        $this->get("/")->assertSeeLivewire("contact-form");
    }

    public function test_submit_fails_when_first_name_field_is_empty()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set("last_name", "User")
            ->set("email", $this->fromEmail)
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["first_name" => "required"]);
    }

    public function test_submit_fails_when_last_name_field_is_empty()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("email", $this->fromEmail)
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["last_name" => "required"]);
    }

    public function test_submit_fails_when_email_field_is_empty()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["email" => "required"]);
    }

    public function test_submit_fails_when_email_field_contains_faulty_email_address()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", "test") // testing if email at all
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["email" => "email"]);

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", "test@test") // testing if email has tld
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["email" => "email"]);

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", "test@test.asd") // test if real tld used
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertHasErrors(["email" => "email"]);
    }

    public function test_submit_fails_when_message_field_is_empty()
    {
        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", "test@test.asd")
            ->call("submit")
            ->assertHasErrors(["message" => "required"]);
    }

    public function test_submit_fails_when_message_field_content_is_too_short()
    {
        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", "test@test.asd")
            ->set("message", "123") // min length 4
            ->call("submit")
            ->assertHasErrors(["message" => "min"]);
    }

    public function test_email_gets_sent_when_all_fields_filled_out_correctly()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set("first_name", "Test")
            ->set("last_name", "User")
            ->set("email", $this->fromEmail)
            ->set("message", "This is a test message")
            ->call("submit")
            ->assertSee("Mail has successfully been sent!");

        Mail::assertQueued(function (ContactFormMailable $mail) {
            $mail->build();
            return $mail->hasTo("example@ttg.com") &&
                $mail->hasFrom($this->fromEmail) &&
                $mail->subject === "New Contact Form Submission";
        });
    }
}
