<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = 'book';    
    protected $guarded = [];
    public $timestamps = false;  
    
}