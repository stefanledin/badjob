<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Entry extends Model
{
    protected $fillable = ['started_at', 'ended_at', 'working_with'];

    public function start()
    {
        $this->started_at = Carbon::now();
    }

    public function stop()
    {
        $this->ended_at = Carbon::now();
    }

    public function getDurationAttribute()
    {
        $startedAt = Carbon::createFromTimestamp(strtotime($this->attributes['started_at']));
        if ($this->ended_at) {
            $end = Carbon::createFromTimeStamp(strtotime($this->ended_at));
        } else {
            $end = Carbon::now();
        }
        return $startedAt->diffInMinutes($end);
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
