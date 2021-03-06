<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'name',
        'level_id',
        'lecturer_id'
    ];

    public function level(){
        return $this->belongsTo('App\Models\Level');
    }

    public function lecturer(){
        return $this->belongsTo('App\Models\Lecturer');
    }
}
