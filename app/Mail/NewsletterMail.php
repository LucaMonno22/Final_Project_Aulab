<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Soggetto tradotto: "Iscrizione Newsletter confermata!"
            subject: __('ui.newsletter_email_subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.newsletter-confirm',
        );
    }
}