<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Hall;
use App\Models\Lecturer;
use App\Models\Course;

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
        $lecturers  = Lecturer::all();
        $halls      = Hall::all();
        $courses    = Course::all();
        return view('schedules.create', compact('schedules', 'lecturers', 'halls', 'courses'));
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
            'lecturer_id'   => 'required',
            'date'          => 'required',
            'duration'      => 'required',
        ]);

        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'lecturer_id'   => $request->lecturer_id,
            'date'          => Carbon::parse(str_replace('.', '/', $request->date))->isoFormat('Y-M-D'),
            'duration'      => $request->duration,
        ];

        $schedule_data['duration'] = $request->duration;
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
        $lecturers  = Lecturer::all();
        $halls      = Hall::all();
        $courses    = Course::all();
        return view('schedules.edit', compact('schedule', 'lecturers', 'halls', 'courses'));
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
            'lecturer_id'   => 'required',
            'date'          => 'required',
            'duration'      => 'required',
        ]);

        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'lecturer_id'   => $request->lecturer_id,
            'date'          => Carbon::parse(str_replace('.', '/', $request->date))->isoFormat('Y-M-D'),
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
        $date = Carbon::parse(str_replace('.', '/', $request->date))->isoFormat('Y-M-D');
        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'lecturer_id'   => $request->lecturer_id,
            'date'          => $date,
        ];

        $schedule = Schedule::where('course_id', $request->course_id)
                    ->where('hall_id', $request->hall_id)
                    ->where('lecturer_id', $request->lecturer_id)
                    ->where('date', $date)->get();


        $response = '';
        ($schedule->count() > 0)? $response = 'true' : $response = 'false';

        return response()->json($response, 200);
    }

    public function showlist(){
        $schedules = Schedule::latest()->paginate(env('PAGINATE'));
        return view('schedules.showlist', compact('schedules'));
    }
}
