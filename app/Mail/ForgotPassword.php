<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $url;

    public function __construct($user, $token, $url)
    {
        $this->user = $user;
        $this->token = $token;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.password_reset')
            ->subject('Recuperación de Contraseña');
    }
}
