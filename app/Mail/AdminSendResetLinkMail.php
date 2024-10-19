<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminSendResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $name;
    public $device;
    public $time;
    /**
     * Create a new message instance.
     */
    public function __construct($token, $email, $name, $device, $time)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
        $this->device = $device;
        $this->time = $time;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Send Reset Link Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-reset-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}