<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

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

    public static function generateTimetable(){
        $schedules = self::all();
        
        $timetable = [];

        $start_time = CarbonImmutable::parse("09:00:00");
        $end_time   = CarbonImmutable::parse("17:00:00");
        $break_time = Carbon::parse("12:00:00");

        $today      = CarbonImmutable::today();

        while(Schedule::sum('occurence') > 0){
            foreach($schedules as $schedule){
                
                if($schedule->occurence > 0){
                    $course_end_time = $start_time->add($schedule->duration, 'hour');
                
    
                    if($break_time->ne($course_end_time) && $break_time->between($start_time, $course_end_time)){
                        $course_end_time = $course_end_time->add(1, 'hour');
                    }
                    
                    
                    if($break_time->eq($start_time) && $break_time->between($start_time, $course_end_time)){
                        
                        $data = [
                            'course_code' => 'Break',
                            'course' => 'Break',
                            'hall' => 'Break',
                            'level' => 'Break',
                            'lecturer' => 'Break',
                            'from' => $start_time->format('g:i A'),
                            'to' => '1:00 PM',
                            'date' => $today->isoFormat('dddd D'),
                            'duration' => 'Break',
                            'break' => ($break_time->between($start_time, $course_end_time))? 'yes' : 'no',
                            'break_eq' => ($break_time->eq($start_time))? 'yes' : 'no',
                            'schedule' => $schedule,
                            
                        ];

                        $data = (object) $data;
                        
                        $timetable[] = $data;

                        $start_time = $start_time->add(1, 'hour');
                        //$course_end_time = $course_end_time->add(1, 'hour');
                    }
    
                    if($start_time->gt($end_time)){
                        $today = $today->add(1, 'day');
                        if($today->isWeekend()){
                            $today = $today->add(2, 'day');
                        }
                        $start_time = CarbonImmutable::parse("09:00:00");
                        $course_end_time = $start_time->add($schedule->duration, 'hour');
                    }
    
                    $data = [
                        'course_code' => $schedule->course->course_code,
                        'course' => $schedule->course->name,
                        'hall' => $schedule->hall->name,
                        'level' => $schedule->course->level->name,
                        'lecturer' => $schedule->course->lecturer->lastname . ' ' . $schedule->course->lecturer->firstname,
                        'from' => $start_time->format('g:i A'),
                        'to' => $course_end_time->format('g:i A'),
                        'date' => $today->isoFormat('dddd D'),
                        'duration' => $schedule->duration,
                        'break' => ($break_time->between($start_time, $course_end_time))? 'yes' : 'no',
                        'break_eq' => ($break_time->eq($start_time))? 'yes' : 'no',
                        'schedule' => $schedule,
                    ];
    
                    $start_time = $course_end_time;
    
                    
    
                    $data = (object) $data;
                    $timetable[] = $data;
    
                    $schedule->increaseOccurenceLoopCount();
                }
            }
        }

        foreach($schedules as $schedule){
            $schedule->resetOccurenceLoopCount();
        }

        return $timetable;
    }

    public function increaseOccurenceLoopCount(){
        $occurence = $this->occurence;
        $occurence_loop_count = $this->occurence_loop;

        if($occurence > 0){
            $occurence_loop_count++;
            $occurence--;

            $this->occurence_loop = $occurence_loop_count;
            $this->occurence = $occurence;
            $this->save();
        }
    }

    public function resetOccurenceLoopCount(){
        $occurence_loop_count = $this->occurence;
        $occurence = $this->occurence_loop;

        $this->occurence = $occurence;
        $this->occurence_loop = $occurence_loop_count;

        $this->save();
    }
}
