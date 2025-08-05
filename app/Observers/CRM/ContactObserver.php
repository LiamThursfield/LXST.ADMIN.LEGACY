<?php

namespace App\Observers\CRM;

use App\Models\CRM\Contact;
use App\Models\CRM\FormSubmission;


class ContactObserver
{
    /**
     * Handle the Contact "updated" event.
     */
    public function updated(Contact $contact): void
    {
        if ($contact->isDirty('is_spam')) {
            // Update any necessary form submissions to match the contacts spam status
            FormSubmission::where('contact_id', $contact->id)
                ->where('is_spam', !$contact->is_spam)
                ->update([
                'is_spam' => $contact->is_spam
            ]);
        }
    }
}
