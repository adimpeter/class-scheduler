<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Schedule;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index($scheduleType=null){
        $timetable = Schedule::generateTimetable();

        return view('app', compact('timetable'));
    }
}
