<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    // Definiamo la proprietà pubblica per accedere ai dati nella vista
    public $user;

    /**
     * Passiamo l'utente al costruttore
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Impostiamo l'oggetto della mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('ui.newUserRegistered'),
        );
    }

    /**
     * Colleghiamo la vista (assicurati che esista in resources/views/emails/welcome.blade.php)
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.registered',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
