<?php

namespace App\Providers;

use App\Events\CompteOpened;
use App\Events\CompteBlocked;
use App\Events\CompteRejected;
use App\Events\ClientRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\CompteOpenedListener;
use App\Listeners\SendEmailNotification;
use App\Listeners\CompteRejectedListener;
use App\Listeners\SendBlockedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ClientRegistered::class => [
            SendEmailNotification::class,
        ],
        CompteBlocked::class =>[
            SendBlockedNotification::class,
        ],
        CompteOpened::class =>[
            CompteOpenedListener::class,
        ],
        CompteRejected::class => [
            CompteRejectedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
