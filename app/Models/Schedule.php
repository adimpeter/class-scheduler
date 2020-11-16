<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'hall_id',
        'lecturer_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function lecturer(){
        return $this->belongsTo('App\Models\Lecturer');
    }

    public function hall(){
        return $this->belongsTo('App\Models\Hall');
    }
}
