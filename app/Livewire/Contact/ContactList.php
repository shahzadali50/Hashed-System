<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\ContactUs;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $contacts;
    public  $contactId, $contact ;
    public $name, $email, $subject, $message;

    public function mount()
    {
        // Fetch the contacts from the database when the component is mounted
        $this->contacts = ContactUs::orderBy('created_at', 'desc') ->paginate(5);
    }
    public function contactView($id)
    {
          // Fetch the contact by its ID
          $contact = ContactUs::findOrFail($id);

          // Set the form data
          $this->contactId = $contact->id;
          $this->name = $contact->name;
          $this->email = $contact->email;
          $this->subject = $contact->subject;
          $this->message = $contact->message;

    }

    public function render()
    {
        return view('livewire.contact.contact-list', [
            'contacts' => ContactUs::orderBy('created_at', 'desc')->paginate(3),
        ]);
    }

}
