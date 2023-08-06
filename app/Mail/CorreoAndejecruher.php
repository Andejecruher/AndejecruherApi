<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoAndejecruher extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $asunto;

    public function __construct($nombre, $asunto)
    {
        $this->nombre = $nombre;
        $this->asunto = $asunto;
    }

    public function build()
    {
        return $this->subject('Respuesta a su mensaje')
            ->view('emails.correo-electronico');
    }
}
