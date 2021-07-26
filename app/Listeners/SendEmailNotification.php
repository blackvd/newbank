<?php

namespace App\Listeners;

use App\Events\ClientRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OpenAccountProcessMail;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
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
     * @param  ClientRegistered  $event
     * @return void
     */
    public function handle(ClientRegistered $event)
    {
        Mail::to($event->client->email)->send(new OpenAccountProcessMail($event->client));
    }
}
