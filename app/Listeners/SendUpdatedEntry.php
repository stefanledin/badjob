<?php

namespace App\Listeners;

use App\Events\EntryUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUpdatedEntry
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
     * @param  EntryUpdated  $event
     * @return void
     */
    public function handle(EntryUpdated $event)
    {
        //
    }
}
