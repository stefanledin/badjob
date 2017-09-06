<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['started_at', 'duration', 'working_with'];

    public function addTime()
    {
        $this->duration += 15;
    }
}
