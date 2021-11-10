<?php

namespace App\Listeners;

use App\Events\PretDone;
use App\Mail\PretDoneMail;
use App\Events\PretRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PretDoneListener
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
     * @param  PretDone  $event
     * @return void
     */
    public function handle(PretDone $event)
    {
        $client = $event->client;
        Mail::to($event->client->email)->send(new PretDoneMail($client));
    }
}
