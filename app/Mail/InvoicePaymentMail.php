<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoicePaymentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $name;
    public $email;
    public $phone;
    public $invoice;
    public $category;
    public $organization;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data)
    {
        $this->name = $user_data->name;
        $this->email = $user_data->email;
        $this->phone = $user_data->phone;
        $this->invoice = $user_data->invoice;
        $this->category = $user_data->category;
        $this->organization = $user_data->organization;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Submission and Verification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.invoice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
