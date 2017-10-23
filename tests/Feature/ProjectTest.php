<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Carbon\Carbon;

use App\Project;
use App\Entry;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testExample()
    {
        $response = $this->json('POST', '/projects', [
            'name' => 'New project'
        ]);
        $response->assertStatus(200)->assertJson([
            'name' => 'New project'
        ]);
        $this->assertDatabaseHas('projects', [
            'name' => 'New project'
        ]);
    }
}
