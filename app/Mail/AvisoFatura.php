<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Fatura;

class AvisoFatura extends Mailable
{
    use SerializesModels;

    public $fatura;

    public function __construct(Fatura $fatura)
    {
        $this->fatura = $fatura;
    }

    public function build()
    {
        return $this->subject('Aviso de Vencimento - Sua Fatura')
                    ->view('emails.aviso-fatura');
    }
}
