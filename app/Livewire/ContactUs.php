<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactUs As ContactMessage;

class ContactUs extends Component
{
    public $name, $email, $subject, $message;

    protected $rules = [
        'name' => ['required', 'string', 'max:30'],
        'email' => 'required|email',
        'subject' => ['required', 'string', 'max:40'],
        'message' => 'required|string',
    ];
    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email.',
        'email.email' => 'Please enter a valid email address.',
        'subject.required' => 'Please enter a subject.',
        'message.required' => 'Please enter your message.',
    ];

    public function addContact()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);
        $this->reset();
        flash()->success('Your message has been sent. Thank you!');
       session()->flash('success_message', 'Your message has been sent. Thank you!');
    }
    public function render()
    {
        return view('livewire.contact-us');
    }
}
