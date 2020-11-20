<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;

class LecturerController extends Controller
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
        $lecturers = Lecturer::orderBy('id', 'desc')->take(10)->get();
        return view('lecturer.create', compact('lecturers'));
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
            'firstname' => 'required',
            'lastname'  => 'required', 
        ]);

        $lecturer = Lecturer::create([
            'firstname' => ucwords($request->firstname),
            'lastname'  => ucwords($request->lastname)
        ]);

        return redirect()->back()->with('success', 'Lecturer ' . $lecturer->firstname . ' ' . $lecturer->lastname . ' has been added successfully');
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
    public function edit(Lecturer $lecturer)
    {
        return view('lecturer.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required', 
        ]);

        $lecturer->update([
            'firstname' => ucwords($request->firstname),
            'lastname'  => ucwords($request->lastname)
        ]);

        return redirect()->back()->with('success', 'Lecturer has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->back()->with('success', 'Lecturer Successfully Deleted');
    }


    public function showlist(){
        $lecturers = Lecturer::latest()->paginate(env('PAGINATE'));
        return view('lecturer.showlist', compact('lecturers'));
    }
}
