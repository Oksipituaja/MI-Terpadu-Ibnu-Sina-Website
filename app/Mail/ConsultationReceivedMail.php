<?php

namespace App\Mail;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Consultation $consultation
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pertanyaan Anda Telah Diterima - MI Terpadu Ibnu Sina',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.consultation-received',
        );
    }
}