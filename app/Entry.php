<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Entry extends Model
{
    protected $fillable = ['started_at', 'ended_at', 'duration', 'working_with'];

    public function start()
    {
        $this->started_at = Carbon::now();
    }

    public function stop()
    {
        $this->ended_at = Carbon::now();
    }

    public function addTime()
    {
        $this->duration += 0.25;
    }

    public function removeTime()
    {
        $this->duration -= 0.25;
    }

    public function setEndedAtAttribute(Carbon $dateTime)
    {
        $diff = $this->attributes['started_at']->diffInMinutes($dateTime);
        $duration = $this->mround($diff);
        
        $this->attributes['duration'] = $this->duration + $duration;
        $this->attributes['ended_at'] = $dateTime;
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
