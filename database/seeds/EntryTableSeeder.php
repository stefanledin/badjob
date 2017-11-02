<?php

use Carbon\Carbon;
use App\Entry;

use Illuminate\Database\Seeder;

class EntryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entries')->insert([
            'started_at' => Carbon::create(2017, 10, 10, 07, 00),
            'ended_at' => Carbon::create(2017, 10, 10, 07, 25)
        ]);
    }
}
