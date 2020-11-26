<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Hall;
use App\Models\Course;
use App\Exports\SchedulesExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules  = Schedule::latest()->get();
        $halls      = Hall::all();
        $courses    = Course::all();
        return view('schedules.create', compact('schedules', 'halls', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id'     => 'required',
            'hall_id'       => 'required',
            'duration'      => 'required',
            'occurence'     => 'required',
        ]);

        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'occurence'     => $request->occurence,
            'duration'      => $request->duration,
        ];

        Schedule::create($schedule_data);

        return redirect()->back()->with('success', 'Your schedule has been created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $halls      = Hall::all();
        $courses    = Course::all();
        return view('schedules.edit', compact('schedule', 'halls', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
         $request->validate([
            'course_id'     => 'required',
            'hall_id'       => 'required',
            'duration'      => 'required',
            'occurence'     => 'required',
        ]);

        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'occurence'     => $request->occurence,
            'duration'      => $request->duration,
        ];

        $schedule->update($schedule_data);
        return redirect()->route('schedule.showlist')->with('success', 'Your schedule has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Schedule Successfully Deleted');
    }

    public function doesSimilarScheduleExist(Request $request){
        
        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'occurence'     => $request->occurence,
        ];

        $schedule = Schedule::where('course_id', $request->course_id)
                    ->where('hall_id', $request->hall_id)
                    ->where('occurence', $request->occurence)
                    ->where('duration', $request->duration)->get();


        $response = '';
        ($schedule->count() > 0)? $response = 'true' : $response = 'false';

        return response()->json($response, 200);
    }

    public function showlist(){
        $timetable = Schedule::generateTimetable();
        // $schedules = Schedule::latest()->paginate(env('PAGINATE'));
        return view('schedules.showlist', compact('timetable'));
    }

    public function export(){
        return Excel::download(new SchedulesExport, 'schedule.xlsx');
    }
}
