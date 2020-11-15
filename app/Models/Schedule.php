<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function course(){
        return $this->hasOne('App/Course');
    }

    public function lecturer(){
        return $this->hasOne('App/Lecturer');
    }

    public function hall(){
        return $this->hasOne('App/Hall');
    }
}
