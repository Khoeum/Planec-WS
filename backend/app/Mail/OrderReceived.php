<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    public array $orderData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Get the message envelope (subject line).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🛒 New Order #' . $this->orderData['orderId'] . ' — PLANEC Shop',
        );
    }

    /**
     * Get the message content (which blade view to use).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-received',
            with: [
                'order' => $this->orderData,
            ],
        );
    }
}