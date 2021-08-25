<?php

namespace App\Listeners;

use App\Models\Compte;
use App\Events\CompteBlocked;
use App\Mail\AccountBlockMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBlockedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompteBlocked  $event
     * @return void
     */
    public function handle(CompteBlocked $event)
    {
        $compte = $event->client->comptes[0];
        Mail::to($event->client->email)->send(new AccountBlockMail($compte));
    }
}
