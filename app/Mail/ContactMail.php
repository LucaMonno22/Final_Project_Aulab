<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    // Proprietà pubblica per accedere ai dati nella vista email
    public $contactData;

    public function __construct($data)
    {
        $this->contactData = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Usa la traduzione UI per l'oggetto della mail
            subject: __('ui.emailSubject') . ($this->contactData['subject'] ?? ''),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact', 
        );
    }
}
