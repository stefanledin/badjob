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
        $this->ended_at = null;
    }

    public function stop()
    {
        $startedAt = Carbon::createFromTimestamp(strtotime($this->attributes['started_at']));
        $endedAt = Carbon::now();

        $diff = $startedAt->diffInMinutes($endedAt);
        $duration = $this->mround($diff);
        
        $this->duration = $this->duration + $duration;
        $this->ended_at = $endedAt;
    }

    public function timeSpent()
    {
        $startedAt = Carbon::createFromTimestamp(strtotime($this->attributes['started_at']));
        if ($this->ended_at) {
            $end = Carbon::createFromTimeStamp(strtotime($this->ended_at));
        } else {
            $end = Carbon::now();
        }
        $diff = $startedAt->diff($end);
        return sprintf('%s h %s m %s s',
            $diff->h,
            $diff->i,
            $diff->s
        );
    }

    public function addTime()
    {
        $this->duration += 0.25;
    }

    public function removeTime()
    {
        $this->duration -= 0.25;
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
