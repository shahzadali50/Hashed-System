<?php

namespace App\Services;

use App\Models\ContactUs;

class ContactService
{
    public function getAllContacts()
    {
        return ContactUs::latest()->get();
    }

public function createContact(array $data): ContactUs
{
    return ContactUs::create($data);
}
}
