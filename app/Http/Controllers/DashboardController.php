<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $timetable = Schedule::generateTimetable();

        return view('dashboard.index', compact('timetable'));
    }
}
