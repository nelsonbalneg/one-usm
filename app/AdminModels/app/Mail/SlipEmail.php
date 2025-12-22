<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SlipEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;
    public $filePath;
    /**
     * Create a new message instance.
     */
    public function __construct($details, $filePath)
    {
        $this->details = $details;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Slip Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.slip-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->filePath) // Path to your PDF file
            ->as('CEE_Exam_Slip.pdf') // Rename the attachment if needed
            ->withMime('application/pdf'), // MIME type
        ];
    }

    public function withSymfonyMessage($message)
    {
        // Delete the PDF after the email is sent
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
