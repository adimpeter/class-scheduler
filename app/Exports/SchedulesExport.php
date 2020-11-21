<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SchedulesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $schedules = Schedule::all();
        $schedule_data = [];
        $count = 1;
        foreach($schedules as $schedule){
            $name = "N/A";
            if(isset($schedule->lecturer->lastname)){
                $name = $schedule->lecturer->lastname;
            }

            if(isset($schedule->lecturer->firstname)){
                $name .= ' ' . $schedule->lecturer->firstname;
            }

            $schedule_data[] = [
                'sn/o'          => $count++,
                'Course Code'   => $schedule->course->course_code ?? 'N/A',
                'Course'        => $schedule->course->name ?? 'N/A',
                'Level'         => $schedule->course->level->name ?? 'N/A',
                'Lecturer'      => $name,
                'Hall'          => $schedule->hall->name ?? 'N/A',
                'Date'          => $schedule->date ?? 'N/A',
                'Duration'      => $schedule->duration ?? 'N/A',
                'Occurence'     => $schedule->occurence(),
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
            "Level", 
            "Lecturer", 
            "Hall", 
            "Date", 
            "Duration (Hours)",
            "Occurence"
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
