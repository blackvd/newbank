<?php

namespace App\Mail;

use App\Models\Carte;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardBlockMail extends Mailable
{
    use Queueable, SerializesModels;

    public $carte;
    public $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Carte $carte, Client $client)
    {
        $this->carte = $carte;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.card_block');
    }
}
