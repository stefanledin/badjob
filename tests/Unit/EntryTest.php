<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Entry;
use Carbon\Carbon;

class EntryTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_start_and_stop()
    {
        $entry = new Entry();
        Carbon::setTestNow(Carbon::create(2017, 10, 10, 13, 00));
        $entry->start();
        Carbon::setTestNow(Carbon::create(2017, 10, 10, 14, 15));
        $entry->stop();
        Carbon::setTestNow();
        $this->assertEquals($entry->duration, 75);
    }

}
