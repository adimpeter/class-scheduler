<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Level;

class CourseController extends Controller
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
        $courses    = Course::orderBy('id', 'desc')->take(10)->get();
        $levels     = Level::all();
        return view('course.create', compact('courses', 'levels'));
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
            'course_code'   => 'required',
            'name'          => 'required', 
            'level_id'      => 'required',
        ]);

        Course::create([
            'course_code' => strtoupper($request->course_code),
            'level_id' => $request->level_id,
            'name'  => ucwords($request->name)
        ]);

        return redirect()->back()->with('success', 'Course has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $courses    = Course::all();
        $levels     = Level::all();
        return view('course.edit', compact('course', 'courses', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code'   => 'required',
            'name'          => 'required', 
            'level_id'      => 'required',
        ]);

       $course->update([
            'course_code' => strtoupper($request->course_code),
            'level_id' => $request->level_id,
            'name'  => ucwords($request->name)
        ]);

        return redirect()->back()->with('success', 'Course has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course Successfully Deleted');
    }

    public function showlist(){
        $courses = Course::latest()->paginate(env('PAGINATE'));
        return view('course.showlist', compact('courses'));
    }

    public static function hasMaxCourse(Request $request){
        $level_id = $request->level_id;
        $max_number_of_courses = Level::where('id', $level_id)->first()->max_number_of_courses;
        $course_count_for_level = Course::where('level_id', $level_id)->get()->count();

        return ($course_count_for_level < $max_number_of_courses)? 'false' : 'true';
    }
}
