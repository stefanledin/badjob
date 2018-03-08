<?php

namespace App\Listeners;

use App\Events\EntryCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreatedEntry
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
     * @param  EntryCreated  $event
     * @return void
     */
    public function handle(EntryCreated $event)
    {
        //
    }
}
