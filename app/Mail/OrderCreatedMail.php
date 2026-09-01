<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $order
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Нове замовлення — Alfirka',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-created',
        );
    }
}