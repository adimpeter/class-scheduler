<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'hall_id',
        'lecturer_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'occurence',
    ];

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function lecturer(){
        return $this->belongsTo('App\Models\Lecturer');
    }

    public function hall(){
        return $this->belongsTo('App\Models\Hall');
    }

    public function occurence(){
        return \App\Models\Schedule::where('hall_id', $this->hall_id)
                                    ->where('course_id', $this->course_id)
                                    ->get()->count();
    }

    public static function generateSchedule(){
        $schedules = self::all();
        $timetable = [];

        $start_time = Carbon::now();
        $end_time   = Carbon::parse("17:00:00");

        $today      = Carbon::today();

        foreach($schedules as $schedule){
            
            $course_end_time = $start_time->add($schedule->duration, 'hour');

            $timetable[] = [
                'course' => $schedule->course->name,
                'hall' => $schedule->hall->name,
                'lecturer' => $schedule->course->lastname . ' ' . $schedule->course->firstname,
                'from' => $start_time,
                'to' => $course_end_time,
                'date' => $today,
            ];
        }

        return collect($timetable);
    }
}
