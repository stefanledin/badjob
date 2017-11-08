<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    protected $fillable = ['name', 'timer_started_at'];

    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    public function getDurationAttribute()
    {
        $duration = 0;
        foreach ($this->entries()->get() as $entry) {
            $duration += $this->mround($entry->duration);
        }
        return $duration;
    }

    // Stulet från mround-funktionen i Excel (tydligen.)
    // https://stackoverflow.com/questions/14903379/rounding-to-nearest-fraction-half-quarter-etc
    public function mround($duration)
    {
        $duration = $duration / 60;
        $duration = round($duration * 4);
        return $duration / 4;
    }
}
