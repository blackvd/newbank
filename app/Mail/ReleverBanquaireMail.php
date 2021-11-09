<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReleverBanquaireMail extends Mailable
{
    use Queueable, SerializesModels;

    public $trans;
    public $compte;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Compte $compte, $trans)
    {
        $this->compte = $compte;
        $this->trans = $trans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.releverMail')->subject("Demande de relever de compte NewBank");
    }
}
