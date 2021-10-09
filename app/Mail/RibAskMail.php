<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Compte;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RibAskMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client;
    public $compte;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, Compte $compte)
    {
        $this->client = $client;
        $this->compte = $compte;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.rib');
    }
}
