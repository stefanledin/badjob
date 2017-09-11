<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTime;

class Entry extends Model
{
    protected $fillable = ['started_at', 'ended_at', 'duration', 'working_with'];

    public function addTime()
    {
        $this->duration += 15;
    }

    public function stop()
    {
        
    }

    public function setEndedAtAttribute(DateTime $dateTime)
    {
        $diff = $this->attributes['started_at']->diff($dateTime);
        $duration = $this->mround($diff->format('%i'));
        
        $this->attributes['duration'] = $duration;
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
