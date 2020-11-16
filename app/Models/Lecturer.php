<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;


    protected $fillable = [
        'firstname',
        'lastname'
    ];

    public function schedule(){
        return $this->belongsTo('App\Models\Schedule');
    }
}
