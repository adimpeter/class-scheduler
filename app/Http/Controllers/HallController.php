<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;

class HallController extends Controller
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
        $halls = Hall::orderBy('id', 'desc')->take(10)->get();
        return view('halls.create', compact('halls'));
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
            'name'  => 'required', 
        ]);

        Hall::create([
            'name' => ucwords($request->name),
        ]);

        return redirect()->back()->with('success', 'Hall has been added successfully');
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
    public function edit(Hall $hall)
    {
        return view('halls.edit', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        $request->validate([
            'name'     => 'required',
        ]);

        $hall_data = [
            'name'     => $request->name,
        ];

        $hall->update($hall_data);
        return redirect()->route('hall.showlist')->with('success', 'Hall has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();
        return redirect()->back()->with('success', 'Hall Successfully Deleted');
    }

    public function showlist(){
        $halls = Hall::latest()->paginate(env('PAGINATE'));
        return view('halls.showlist', compact('halls'));
    }
}
