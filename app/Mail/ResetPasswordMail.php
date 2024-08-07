<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $resetCode;

    public function __construct($resetCode)
    {
        $this->resetCode = $resetCode;
    }

    public function build()
    {
        return $this->view('emails.reset_password')
                    ->with(['resetCode' => $this->resetCode]);
    }
}
