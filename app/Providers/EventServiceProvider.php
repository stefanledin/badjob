<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ProjectCreated' => [
            'App\Listeners\SendCreatedProject',
        ],
        'App\Events\ProjectDeleted' => [
            'App\Listeners\SendDeletedProject',
        ],
        'App\Events\EntryCreated' => [
            'App\Listeners\SendCreatedEntry',
        ],
        'App\Events\EntryUpdated' => [
            'App\Listeners\SendUpdatedEntry',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
