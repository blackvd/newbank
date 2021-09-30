<?php

namespace App\Listeners;

use App\Events\CompteRejected;
use App\Mail\RequestRejectMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompteRejectedListener
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
     * @param  CompteRejected  $event
     * @return void
     */
    public function handle(CompteRejected $event)
    {
        Mail::to($event->client->email)->send(new RequestRejectMail($event->client->comptes[0]));
    }
}
