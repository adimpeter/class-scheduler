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

        
        
        $count = 1;
        foreach($timetable as $data){
            
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
