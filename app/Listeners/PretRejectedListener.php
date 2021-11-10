<?php

namespace App\Listeners;

use App\Events\PretRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\PretRejected as MailPretRejected;
use App\Mail\PretRejectedMail;
use App\Models\Client;

class PretRejectedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public $client;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param  PretRejected  $event
     * @return void
     */
    public function handle(PretRejected $event)
    {
        $client = $event->client;
        Mail::to($event->client->email)->send(new PretRejectedMail($client));
    }
}
