<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $brand; // AGGIUNTA: Proprietà per la marca della carta

    // MODIFICA: Il costruttore ora accetta sia l'ordine che il brand
    public function __construct(Order $order, $brand)
    {
        $this->order = $order;
        $this->brand = $brand;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('ui.orderConfirmation') . ' Komerz #' . $this->order->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.order-confirmed',
        );
    }
}
