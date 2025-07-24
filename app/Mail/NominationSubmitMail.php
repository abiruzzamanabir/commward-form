<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NominationSubmitMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $name;
    public $email;
    public $phone;
    public $category;
    public $transaction_id;
    public $organization;
    public $amount;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_information,$order_details)
    {
        $this->name = $order_information->name;
        $this->email = $order_information->email;
        $this->phone = $order_information->phone;
        $this->category = $order_information->category;
        $this->organization = $order_information->organization;
        $this->transaction_id = $order_details->transaction_id;
        $this->amount = $order_details->amount;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Payment Received Mail',
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
            view: 'email.nomination',
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
