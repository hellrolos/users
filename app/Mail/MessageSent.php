<?php

namespace App\Mail;

use App\Consultas\DBModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Solicitud para recuperar el password';
    public $token;
    protected $consultas;
    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token=$token;
        $this->consultas = new DBModel();
        $idPersona =  $this->consultas->getPersona($this->token->email);
        $persona = $this->consultas->getPersonData($idPersona);
        $this->datos = [
            'nombre' => $persona[0]->nombre,
            'ap_paterno' => $persona[0]->ap_paterno,
            'ap_materno' => $persona[0]->ap_materno,
            'token' => $this->token->token,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send');
    }
}
