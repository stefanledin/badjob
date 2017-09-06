<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Entry;

class EntryTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_starts_working_on_a_project()
    {
        $entry = Entry::create([
            'started_at' => new \DateTime('2017-10-10 07:00'),
            'duration' => 15,
            'working_with' => 'Badjob'
        ]);

        $this->assertDatabaseHas('entries', [
            'working_with' => 'Badjob',
            'duration' => 15
        ]);
    }

    public function test_adds_fifteen_minutes_to_a_project()
    {
        $entry = Entry::create([
            'started_at' => new \DateTime('2017-10-10 07:15'),
            'duration' => 15
        ]);

        $entry->addTime();

        $entry->save();

        $this->assertDatabaseHas('entries', [
            'duration' => 30
        ]);
    }
}
