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
            'working_with' => 'Badjob'
        ]);

        $this->assertDatabaseHas('entries', [
            'working_with' => 'Badjob'
        ]);
    }
}
