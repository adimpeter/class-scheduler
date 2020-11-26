<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

class SchedulesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $schedules = Schedule::all();
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
        
        $count = 1;
        foreach($timetable as $data){
            // $name = "N/A";
            // if(isset($data->lecturer->lastname)){
            //     $name = $schedule->lecturer->lastname;
            // }

            // if(isset($data->lecturer->firstname)){
            //     $name .= ' ' . $schedule->lecturer->firstname;
            // }

            $schedule_data[] = [
                'sn/o'          => $count++,
                'Course Code'   => $data->course_code,
                'Course'   => $data->course ?? 'N/A',
                'Hall'        => $data->hall ?? 'N/A',
                'Level'         => $data->level ?? 'N/A',
                'Lecturer'      => $data->lecturer ?? 'N/A',
                'From'          => $data->from ?? 'N/A',
                'To'            => $data->to ?? 'N/A',
                'Date'          => $data->date,
            ];
        }
        
        return collect($schedule_data);
    }

    public function headings(): array
    {
        return [
            "SN/O", 
            "Course Code",
            "Course", 
            "Hall", 
            "Level", 
            "Lecturer", 
            "From", 
            "To", 
            "Date"
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
