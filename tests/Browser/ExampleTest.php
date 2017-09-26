<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    public function test_start_and_stop() {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('working_with', 'BadJob-projektet')
                ->press('Börja!')
                ->assertSee('BadJob-projektet');
        });
        $this->assertDatabaseHas('entries', ['working_with' => 'BadJob-projektet']);
    }
}
