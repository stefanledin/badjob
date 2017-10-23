<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Carbon\Carbon;
use App\Project;
use App\Entry;

class ProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function test_project_has_a_name()
    {
        $project = Project::create([
            'name' => 'BadJob'
        ]);
        $this->assertDatabaseHas('projects', [
            'name' => 'BadJob'
        ]);
    }

    public function test_project_has_a_time_entry()
    {
        $project = Project::create([
            'name' => 'BadJob'
        ]);
        $entry = new Entry();
        $project->entries()->save($entry);
        $this->assertCount(1, $project->entries()->get());
    }

    public function test_project_has_multiple_entries()
    {
        $project = Project::create([
            'name' => 'BadJob'
        ]);
        $project->entries()->createMany($this->createTwoEntries());
        $this->assertCount(2, $project->entries()->get());
        $this->assertEquals(1, $project->duration);
    }

    protected function createTwoEntries()
    {
        return [
            [
                'started_at' => Carbon::create(2017, 11, 11, 07, 00),
                'ended_at' => Carbon::create(2017, 11, 11, 07, 25)
            ],
            [
                'started_at' => Carbon::create(2017, 11, 11, 10, 15),
                'ended_at' => Carbon::create(2017, 11, 11, 10, 45)
            ]
        ];
    }
}
