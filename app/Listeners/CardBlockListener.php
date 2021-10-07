<?php

namespace App\Listeners;

use App\Events\CardBlock;
use App\Mail\CardBlockMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardBlockListener
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
     * @param  CardBlock  $event
     * @return void
     */
    public function handle(CardBlock $event)
    {
        $cpte = $event->client->comptes()->where('type_compte', "1")->first();
        $carte = $cpte->carte()->first();
        // dd($event->client->email);
        Mail::to($event->client->email)->send(new CardBlockMail($carte, $event->client));
    }
}
