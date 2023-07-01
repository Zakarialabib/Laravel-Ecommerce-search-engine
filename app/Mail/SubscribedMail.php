<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscribedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct()
    {
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        $subject = 'Thank you for your subscription'.config('app.name');

        return new Envelope(
            subject: $subject,
        );
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        // return $this->from(('admin@mail.com'))
        // ->replyTo(request()->input('email'))
        // ->markdown('vendor.notifications.email', [
        //     'introLines' => [__('We will get you updated once we will.')],
        // ]);
        return new Content(
            markdown: 'vendor.notifications.email',
        );
    }
}
