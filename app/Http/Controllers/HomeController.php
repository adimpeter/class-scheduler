<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Schedule;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index($scheduleType=null){
        $today = Carbon::today()->isoFormat('Y-M-D');
        $tomorrow = Carbon::tomorrow()->isoFormat('Y-M-D');

        
        switch($scheduleType){
            case 'today':
                $schedules = Schedule::where('date', $today)->paginate(env('PAGINATE'));
            break;
            case 'tomorrow':
                $schedules = Schedule::where('date', $tomorrow)->paginate(env('PAGINATE'));
            break;
            case 'all':
                $schedules = Schedule::latest()->paginate(env('PAGINATE'));
            break;
            default:
                $schedules = Schedule::latest()->paginate(env('PAGINATE'));
        }

        return view('app', compact('schedules' , 'scheduleType'));
    }
}
