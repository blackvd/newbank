<?php

namespace App\Listeners;

use App\Events\PretRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\PretRejected as MailPretRejected;
use App\Mail\PretRejectedMail;

class PretRejectedListener implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  PretRejected  $event
     * @return void
     */
    public function handle(PretRejected $event)
    {
        Mail::to($event->client->email)->send(new PretRejectedMail());
    }
}
