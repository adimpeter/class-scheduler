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
        $schedules  = Schedule::all();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function doesSimilarScheduleExist(Request $request){
        $schedule_data = [
            'course_id'     => $request->course_id,
            'hall_id'       => $request->hall_id,
            'lecturer_id'   => $request->lecturer_id,
            //'date'          => Carbon::parse(str_replace('.', '/', $request->date))->isoFormat('Y-M-D'),
        ];

        $schedule = Schedule::where('course_id', $request->course_id)
                    ->where('hall_id', $request->hall_id)
                    ->where('lecturer_id', $request->lecturer_id)->get();

        $response = '';
        ($schedule->count() > 0)? $response = 'true' : $response = 'false';

        return response()->json($schedule_data, 200);
    }
}
