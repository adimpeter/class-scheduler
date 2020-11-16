<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Hall;
use App\Models\Lecturer;
use App\Models\Course;

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
            'from'          => 'required',
            'to'            => 'required',
        ]);

        // check if there is conflicting schedules
        $conflicting_schedule = Schedule::where('date', $request->date)
                                ->whereBetween('start_time', [$request->from, $request->to])
                                ->whereBetween('end_time', [$request->from, $request->to])
                                ->get();
        
        if($conflicting_schedule->count() > 0){
            return redirect()->back()->with('error', 'A shedule already exists within this time');
        }

        Schedule::create([
            'course_id' => $request->course_id,
            'hall_id'   => $request->hall_id,
            'lecturer_id'   => $request->lecturer_id,
            'date' => $request->date,
            'start_time' => $request->from,
            'end_time'   => $request->to,
        ]);

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
}
