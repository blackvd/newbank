<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Compte;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestValidateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The account instance
     * 
     * @var \App\Models\User
     */
    public $user;

    public $compte;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Compte $compte)
    {
        $this->user = $user;
        $this->compte = $compte;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.request_validate')->subject('Validation');
    }
}
