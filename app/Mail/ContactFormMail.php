<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;
    public $formData;
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'New Contact Form Submission: ' . $this->formData['subject'],
            to: 'ravneetsingh11a@gmail.com',
        );
    }
    public function content()
    {
        return new Content(
            view: 'emails.contact-form',
        );
    }
    public function attachments()
    {
        return [];
    }
}
