<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;

class SchedulesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $schedules = Schedule::all();
        $timetable = Schedule::generateTimetable();
        $time_span = [
            "9AM - 10AM",
            "10AM - 11AM", 
            "11AM - 12PM", 
            "12PM - 1PM", 
            "1PM - 2PM", 
            "2PM - 3PM", 
            "3PM - 4PM", 
            "4PM - 5PM"
        ];
        
        
        $count = 0;
        foreach($timetable as $key => $values){

            $schedule_data[$key][] = $key;
            foreach($values as $value){
                $schedule_data[$key][] = $value->course_code;
            }
            
            
        }
        return collect($schedule_data);
    }

    public function headings(): array
    {
        return [
            "Date / Time", 
            "9AM - 10AM",
            "10AM - 11AM", 
            "11AM - 12PM", 
            "12PM - 1PM", 
            "1PM - 2PM", 
            "2PM - 3PM", 
            "3PM - 4PM", 
            "4PM - 5PM"
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
