<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
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
        $levels  = Level::latest()->get();
        return view('level.create', compact('levels'));
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
            'name'          => 'required',
            'max_courses'   => 'required',
        ]);

        $level_data = [
            'name'                      => ucwords($request->name),
            'max_number_of_courses'     => $request->max_courses,
        ];
         
        Level::create($level_data);

        return redirect()->back()->with('success', 'Level has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name'              => 'required',
            'max_courses'       => 'required',
        ]);

        $level_data = [
            'name'                      => ucwords($request->name),
            'max_number_of_courses'     => $request->max_courses,
        ];
         
        $level->update($level_data);

        return redirect()->back()->with('success', 'Level has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->back()->with('success', 'Level Successfully Deleted');
    }

    public function showlist(){
        $levels = Level::latest()->paginate(env('PAGINATE'));
        return view('level.showlist', compact('levels'));
    }
}
