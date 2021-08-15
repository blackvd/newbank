<?php

namespace App\Listeners;

use App\Events\CompteOpened;
use App\Mail\RequestValidateMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompteOpenedListener
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
     * @param  CompteOpened  $event
     * @return void
     */
    public function handle(CompteOpened $event)
    {
        // dd($event->client->user);
        // dd($event->client->comptes[0]);
        Mail::to($event->client->email)->send(new RequestValidateMail($event->client->user,$event->client->comptes[0]));
    }
}
