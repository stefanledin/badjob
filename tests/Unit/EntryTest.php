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
    
    public function test_starts_working_on_a_project()
    {
        $entry = Entry::create([
            'started_at' => new Carbon('2017-10-10 07:00'),
            'ended_at' => new Carbon('2017-10-10 07:15'),
            'working_with' => 'Badjob'
        ]);

        $this->assertDatabaseHas('entries', [
            'working_with' => 'Badjob',
            'duration' => 0.25
        ]);
    }

    public function test_rounds_to_nearest_quarter()
    {
        $entry = Entry::create([
            'started_at' => new Carbon('2017-10-10 07:00'),
            'ended_at' => new Carbon('2017-10-10 07:25'),
            'working_with' => 'Badjob'
        ]);

        $this->assertDatabaseHas('entries', [
            'working_with' => 'Badjob',
            'duration' => 0.5
        ]);
    }

    public function test_adds_fifteen_minutes_to_a_project()
    {
        $entry = Entry::create([
            'started_at' => new Carbon('2017-10-10 07:30'),
            'ended_at' => new Carbon('2017-10-10 07:49'),
            'duration' => 0.5
        ]);

        $entry->addTime();

        $entry->save();

        $this->assertDatabaseHas('entries', [
            'duration' => 0.75
        ]);
    }

    public function test_start_and_stop()
    {
        $entry = new Entry();
        Carbon::setTestNow(Carbon::create(2017, 10, 10, 13, 00));
        $entry->start();
        Carbon::setTestNow(Carbon::create(2017, 10, 10, 14, 15));
        $entry->stop();
        Carbon::setTestNow();
        $this->assertEquals($entry->duration, 1.25);
    }

    public function test_can_add_and_subtract_fifteen_minutes_manually()
    {
        $entry = new Entry();
        Carbon::setTestNow(Carbon::create(2017, 11, 01, 07, 30));
        $entry->start();
        Carbon::setTestNow(Carbon::create(2017, 11, 01, 07, 16));
        $entry->stop();
        Carbon::setTestNow();
        
        $this->assertEquals($entry->duration, 0.25);
        
        $entry->addTime();
        $entry->addTime();
        $this->assertEquals($entry->duration, 0.75);

        $entry->removeTime();
        $this->assertEquals($entry->duration, 0.5);
    }

    public function test_start_and_stop_and_continue()
    {
        $entry = new Entry();
        Carbon::setTestNow(Carbon::create(2017, 12, 13, 07, 00));
        $entry->start();
        Carbon::setTestNow(Carbon::create(2017, 12, 13, 07, 15));
        $entry->stop();

        $this->assertEquals($entry->duration, 0.25);

        Carbon::setTestNow(Carbon::create(2017, 12, 13, 11, 00));
        $entry->start();
        Carbon::setTestNow(Carbon::create(2017, 12, 13, 11, 15));
        $entry->stop();

        $this->assertEquals($entry->duration, 0.5);
    }
}
