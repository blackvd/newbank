<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Compte;

class AccountOpenMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The account instance
     * 
     * @var \App\Models\Compte
     */
    public $compte;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Compte $compte)
    {
        $this->compte = $compte;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.open_account')->subject("Ouverture de compte");
    }
}
