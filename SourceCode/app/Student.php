<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'student';    
    protected $guarded = [];
    public $timestamps = false;  
    
}