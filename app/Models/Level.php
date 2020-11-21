<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_number_of_courses',
    ];

    public function course(){
        return $this->hasMany('App\Models\Course');
    }

    public function courseCount(){
        return $this->course()->count();
    }
}
